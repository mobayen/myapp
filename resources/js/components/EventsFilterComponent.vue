<template>
  <div class="grid gap-4">
    <div class="rounded-3xl border-2 border-gray-400/30 flex">
      <div class="w-1/2 p-1">
        <button
          class="btn btn-search w-full text-center"
          v-bind:class="{ active: futureEvents }"
          @click="futureEvents = true"
        >
          In the Future
        </button>
      </div>
      <div class="w-1/2 p-1">
        <button
          class="btn btn-search w-full text-center"
          v-bind:class="{ active: !futureEvents }"
          @click="futureEvents = false"
        >
          In the Past
        </button>
      </div>
    </div>

    <div class="my-4 rounded-3xl border border-gray-500/50 bg-white flex">
      <div class="p-2">
        <span class="material-icons text-main-500"> search </span>
      </div>

      <input
        class="leading-9 outline-none w-full bg-transparent"
        type="text"
        placeholder="Search by name or location..."
        autocomplete="off"
        v-model="searchBy"
        @input="emitData"
        
      />
    </div>

    <div class="flex justify-between">
      <label for="location">Event Location</label>
      <div>
        <select @input="emitData" v-model="location">
          <option selected > - select - </option>
          <option value="atl-GA">Atlanta, GA</option>
          <option value="mia-FL">Miami, FL</option>
        </select>
      </div>
    </div>

    <div class="flex justify-between">
      <label for="length-start">Event Length</label>
      <div>
        <select @input="emitData" v-model="lengthStart">
          <option selected > - select - </option>
          <option value="1">1 hour</option>
          <option value="2">2 hours</option>
          <option value="3">3 hours</option>
          <option value="4">4 hours</option>
        </select>
        <label for="length-end">to</label>
        <select @input="emitData" v-model="lengthEnd">
          <option selected > - select - </option>
          <option value="2">2 hours</option>
          <option value="3">3 hours</option>
          <option value="4">4 hours</option>
        </select>
      </div>
    </div>

    <div class="flex justify-between">
      <label for="mincost"> Seat Cost </label>

      <div>
        <span>
          <input
            class="h-10 rounded-3xl outline-none border-2 border-gray-600/30 text-center box-border"
            type="text"
            @input="emitData"
            size="7"
            maxlength="5"
            placeholder="Min"
            autocomplete="off"
            v-model="seatCostMin"
          />
        </span>
        <label for="maxcost">to</label>
        <span>
          <input
            class="h-10 rounded-3xl outline-none border-2 border-gray-600/30 text-center box-border"
            type="text"
            @input="emitData"
            size="7"
            maxlength="5"
            placeholder="Max"
            autocomplete="off"
            v-model="seatCostMax"
          />
        </span>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      futureEvents: true,
      searchBy: '',
      location: '',
      lengthStart: '',
      lengthEnd: '',
      seatCostMin: '',
      seatCostMax: '',
    }
  },

  watch: {
    futureEvents(newValue, oldValue) {
      this.emitData()
    }
  },
  methods: {
    emitData(){

      // TODO: Debounce helps to improve the performance
      this.$emit('change', {
        futureEvents: this.futureEvents,
        searchBy: this.searchBy,
        location: this.location,
        lengthStart: this.lengthStart,
        lengthEnd: this.lengthEnd,
        seatCostMin: this.seatCostMin,
        seatCostMax: this.seatCostMax,
      })
    }
  },
}
</script>
