<template>
  <div class="bg-gray-200/50 py-20">
    <header class="max-width mb-10">
      <h2 class="text-4xl font-bold">
        Events for
        <span class="text-main-500"> every occasion </span>
      </h2>
    </header>

    <main class="max-width flex">
      <div class="w-2/3 pr-4" v-if="!eventsFound">No events found</div>
      <div class="w-2/3 grid grid-cols-2 gap-2 pr-4" v-else>
        <div v-for="event in events" :key="event.id" class="">
          <event-box-component :event="event"></event-box-component>
        </div>

        <div class="max-width p-10 text-center col-span-2">
          <button class="text-main-500 font-bold">View More (100+)</button>
        </div>
      </div>

      <div class="w-1/3">
        <events-filter-component @change="runSearch"></events-filter-component>
      </div>
    </main>
  </div>
</template>

<script>
import axios from 'axios'

export default {
  data() {
    return {
      events: [],
      searchData: {}
    }
  },

  computed: {
    eventsFound() {
      return this.events.length > 0 ? true : false
    },
  },

  mounted() {
    this.pullData()
  },

  methods: {
    runSearch(data) {
      console.log('x runSearch', data);
      this.searchData = data

      this.pullData()
    },

    pullData() {
      axios
        .get('/api/events/search', { params: this.searchData})
        .then((res) => {
          // NOTE: we can do more quality checks.
          // e.g.: if the data is an array and the length is not zero
          if (res.status === 200) {
            this.events = res.data
          }
        })
        .catch((error) => {
          console.log('x2 error', error)

          alert('error: ' + error.message)
        })
    }
  },
}
</script>
