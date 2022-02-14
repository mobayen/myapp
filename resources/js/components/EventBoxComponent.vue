<template>
  <div class="flex flex-col basis-1/3 flex-grow flex-shrink">
    <div class="">
      <div class="relative">
        <div class="">
          <img :src="event.image" alt="" />
        </div>

        <div
          class="absolute bottom-0 inset-x-0 text-sm bg-black/40 text-white px-4"
        >
          <span class="material-icons text-base"> person </span>

          <span>
            {{ event.hostname }}
            •
            {{ eventLength }}
          </span>
        </div>
      </div>
    </div>

    <div class="bg-white px-4 overflow-hidden py-4">
      <div class="font-bold text-lg whitespace-nowrap">
        {{ eventName }}
      </div>

      <div class="text-gray-700/60 whitespace-nowrap text-sm">
        {{ eventFormatedDate }}
        •
        {{ event.location }}
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    event: {
      type: Object,
      required: true,
    },
  },

  computed: {
    eventName() {
      let str = this.event.name
      const length = 30

      if (str.length > length) {
        str = str.substring(0, length) + '...'
      }

      return str
    },

    eventFormatedDate() {
      const date = new Date(this.event.date)
      const options = { year: 'numeric', month: 'short', day: 'numeric' }
      const fmtDate = date.toLocaleDateString('en-US', options)

      return fmtDate
    },

    eventLength() {
      let d = this.event.eventLengthInHours

      if (d == 1) {
        return d + ' hr'
      } else if (d >= 1) {
        return d + ' hrs'
      } else {
        return d * 60 + ' mins'
      }
    },
  },
}
</script>
