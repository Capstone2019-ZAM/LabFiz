<template>
  <div >
    <v-row  justify="center">
      <v-col cols="12" md="9" >
    <v-container>
      <v-row>
        <v-col cols="12" md="3">
          <v-select v-model="selected_report" :items="reports" label="Report" prepend-icon="mdi-file-document"></v-select>
        </v-col>
        <v-col cols="12" md="3">
          <v-select v-model="selected_room" :items="rooms" label="Labarotory" prepend-icon="mdi-office-building"></v-select>
        </v-col>
        <v-col cols="12" md="3">
          <v-select v-model="selected_inspector" :items="inspectors" label="Assigned To" prepend-icon="mdi-account"></v-select>
        </v-col>
        <v-col cols="12" md="3">
          <v-menu>
            <template v-slot:activator="{ on }">
              <v-text-field
                :value="formattedDate"
                label="Due Date"
                prepend-icon="mdi-calendar-range"
                v-on="on"
              ></v-text-field>
            </template>
            <v-date-picker v-model="due_date"></v-date-picker>
          </v-menu>
        </v-col>
      </v-row>
      <v-row ><v-col align="end">
        <v-btn dark>Assign</v-btn></v-col>
      </v-row>
    </v-container>
      </v-col>
    </v-row>
  </div>
</template>

<script>
import format from "date-fns/format";
import parseISO from "date-fns/parseISO";

export default {
  data() {
    return {
      selected_room: null,
      selected_inspector: null,
      selected_report: null,
      due_date: null,
      reports: [
        "Wet Lab",
        "Dry Lab",
        "Chemical Lab",
        "Petroleum Labs",
        "Software Lab"
      ],
      inspectors: ["John Smith", "John Doe", "Ahmed Riaz"],
      rooms: ["ED-100", "ED-200", "ED-301", "ED-412", "PTRC-232", "PTRC-330"]
    };
  },
  computed: {
    formattedDate() {
      return this.due_date
        ? format(parseISO(this.due_date), "Do MMM yyyy")
        : "";
    }
  }
};
</script>