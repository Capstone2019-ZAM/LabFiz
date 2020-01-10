<template>

  <v-card>
    <v-card-title>
      Assignments
      <v-spacer></v-spacer>
      <v-text-field
        v-model="search"
        append-icon="mdi-account-search"
        label="Search"
        single-line
        hide-details
      ></v-text-field>
    </v-card-title>
    <v-data-table
      :headers="headers"
      :items="assignments"
      :search="search"
    ></v-data-table>
  </v-card>
  
</template>


<script>
  export default {
    data () {
      return {
        search: '',
        headers: [
          {
            text: 'Lab',
            align: 'left',
            sortable: true,
            value: 'lab_name',
          },
          { text: 'Status', value: 'status_name' },

          { text: 'Report', value: 'report_name' },
          { text: 'Assigned To', value: 'assignee' },
          { text: 'Due Date', value: 'due_date' },
        ],
        assignments: [
          { status_name:'Pending',
           lab_name:'ED-401',
           assignee: 'John Doe',
           report_name :'Wet Lab',
           due_date: '14-Jan-2020'}  ,
           { status_name:'Pending',
           lab_name:'ED-401',
           assignee: 'John Doe',
           report_name :'Wet Lab',
           due_date: '14-Jan-2020'}  ,
           { status_name:'Pending',
           lab_name:'ED-401',
           assignee: 'John Doe',
           report_name :'Wet Lab',
           due_date: '14-Jan-2020'}  ,
           { status_name:'Pending',
           lab_name:'ED-401',
           assignee: 'John Doe',
           report_name :'Wet Lab',
           due_date: '14-Jan-2020'}  ,
           { status_name:'Pending',
           lab_name:'ED-401',
           assignee: 'John Doe',
           report_name :'Wet Lab',
           due_date: '14-Jan-2020'}  ,        
        ],
      }
    },
  }
</script>