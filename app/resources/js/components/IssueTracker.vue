<template>
<v-container>
    <v-card>
       <v-card-title class="justify-center" >
                <span class="headline" >Issue Tracker Form</span>
        </v-card-title>
        <v-divider></v-divider>
      <v-data-table
        :headers="headers"
        :items="items"
      ></v-data-table>
       <v-btn block outlined >
          Add an Entry
          <v-icon>mdi-plus</v-icon>
        </v-btn>
    </v-card>
</v-container>
</template>


<script>
  export default {
    data () {
      return {
        headers: [
          {
            text: 'Status',
            align: 'left',
            sortable: false,
            value: 'name',
          },
          { text: 'Issue', value: 'issue' },
          { text: 'Room #', value: 'room' },
          { text: 'Assigned To', value: 'assigned' },
          { text: 'Resoluton Date', value: 'date' },
        ],
        items: [
          {
            name: 'Status1',
            issue: 33,
            room: 'ED 123',
            assigned: 'Edward Livingstone',
            date: "Jan 02, 2020",
            
          },
          {
            name: 'Status1',
            issue: 33,
            room: 'ED 123',
            assigned: 'Edward Livingstone',
            date: "Jan 02, 2020",
            
          },
          {
            name: 'Status1',
            issue: 33,
            room: 'ED 123',
            assigned: 'Edward Livingstone',
            date: "Jan 02, 2020",
            
          },
          {
            name: 'Status1',
            issue: 33,
            room: 'ED 123',
            assigned: 'Edward Livingstone',
            date: "Jan 02, 2020",
            
          },
        ],
      }
    },
  }
</script>