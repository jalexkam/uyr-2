<template>
  <div class="container">
    <div class="row my-5">
      <div class="col-md-6 card p-3">
        <FullCalendar :options="calendarOptions"  />
      </div>
    </div>
  </div>
</template>

<script>
import '@fullcalendar/core/vdom' // solves problem with Vite
import FullCalendar from '@fullcalendar/vue'
import dayGridPlugin from '@fullcalendar/daygrid'
import interactionPlugin from '@fullcalendar/interaction'

export default {
  components: {
    FullCalendar // make the <FullCalendar> tag available
  },
  data() {
    return {
      calendarOptions: {
        plugins: [ dayGridPlugin, interactionPlugin ],
        initialView: 'dayGridMonth',
        dateClick: this.handleDateClick,
        editable: true,
        events: [
          { title: 'event 1', date: '2021-08-08' },
          { title: 'event 2', date: '2021-08-07' }
        ]
      }
    }
  },
   methods: {
    handleDateClick: function(arg) {
      prompt('Add Event ' + arg.dateStr)
    }
  }
}
</script>
