<template>
  <div>

      <v-container>
        <v-row>
          <v-col cols="12" md="4">
            <v-select
              v-model="select"
              :items="items"
              label="Report"
            ></v-select>
          </v-col>
          <v-col cols="12" md="4"></v-col>
          <v-col cols="12" md="4"></v-col>
          <v-col cols="12" md="4"></v-col>
        </v-row>
      </v-container>
    
  </div>
</template>

<script>
export default {},
 data () {
    return {
      select: { state: 'Florida', abbr: 'FL' },
      items: [
        { state: 'Florida', abbr: 'FL' },
        { state: 'Georgia', abbr: 'GA' },
        { state: 'Nebraska', abbr: 'NE' },
        { state: 'California', abbr: 'CA' },
        { state: 'New York', abbr: 'NY' },
      ],
    }
  }
;
</script>