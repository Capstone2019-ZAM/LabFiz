<template>
<v-container>
    <v-card>
      <v-card-title class="text-center">
        Account Manager
        <v-spacer></v-spacer>
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
            text: 'First Name',
            align: 'left',
            sortable: false,
            value: 'fname',
          },
          { text: 'Last Name', value: 'lname' },
          { text: 'Role', value: 'role' },
          { text: 'Department', value: 'dept' },
          { text: 'Email', value: 'email' },
          { text: 'Added Date', value: 'date' },
        ],
        items: [
          {
            fname: 'Rob',
            lname: 'Junior',
            role: 'Inspector',
            dept: 'Engineering',
            email: 'test@test.com',
            date: 'Jan 02, 2020',
            
          },
          {
            fname: 'Robert',
            lname: 'Man',
            role: 'Instructor',
            dept: 'Engineering',
            email: 'test@test.com',
            date: 'Jan 02, 2020',
            
          },
          {
            fname: 'Jacob',
            lname: 'Ferno',
            role: 'Inspector',
            dept: 'Engineering',
            email: 'test@test.com',
            date: 'Jan 02, 2020',
            
          },
        ],
      }
    },
  }
</script>