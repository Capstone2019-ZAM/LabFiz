<template>
  <v-row justify="center">
    <v-col cols="12" md="9">
      <v-card>
        <v-card-title>
          All Inspections
          <v-spacer></v-spacer>
          <v-text-field
            v-model="search"
            append-icon="mdi-account-search"
            label="Search"
            single-line
            hide-details
          ></v-text-field>
        </v-card-title>
        <v-data-table :headers="headers" :items="assignments" :search="search">
          <template v-slot:item.status_name="{ item }">
            <!-- <v-chip :color="getColor(item.status_name)" dark>{{ item.status_name }}</v-chip> -->
            <v-radio-group column="false" row="true">
              <v-radio v-for="n in 3" :key="n" :label="` |`" :value="n"></v-radio>
            </v-radio-group>
          </template>

          <v-card>
            <v-card-title>
              <span class="headline">Edit Assignment</span>
            </v-card-title>

            <v-card-text>
              <v-container>
                <v-row>
                  <v-col cols="12" sm="6" md="4">
                    <v-text-field v-model="editedItem.status" label="Fat (g)"></v-text-field>
                  </v-col>
                </v-row>
              </v-container>
            </v-card-text>

            <v-card-actions>
              <v-spacer></v-spacer>
              <v-btn color="blue darken-1" text @click="close">Cancel</v-btn>
              <v-btn color="blue darken-1" text @click="save">Save</v-btn>
            </v-card-actions>
          </v-card>

          <!-- <v-dialog v-model="dialog" max-width="500px"> -->

          <template v-slot:item.action="{ item }">
            <v-icon small class="mr-2" @click="editItem(item)">mdi-pencil</v-icon>
            <v-icon small @click="deleteItem(item)">mdi-delete</v-icon>
          </template>

          <!-- </v-dialog>           -->
        </v-data-table>
      </v-card>
    </v-col>
  </v-row>
</template>


<script>
export default {
  data() {
    return {
      search: "",
      dialog: false,
      headers: [
        {
          text: "Lab",
          align: "left",
          sortable: true,
          value: "lab_name",
          width: "100px"
        },
        { text: "Status", value: "status_name", width: "200px" },

        { text: "Report", value: "report_name", width: "100px" },
        { text: "Assigned To", value: "assignee", width: "100px" },
        { text: "Due Date", value: "due_date", width: "100px" },
        { text: "Actions", value: "action", sortable: false, width: "100px" }
      ],
      editedIndex: -1,
      editedItem: {
        report: "",
        room: "",
        status: "",
        assigned_to: ""
      },
      defaultItem: {
        report: "",
        room: "",
        status: "",
        assigned_to: ""
      },
      created() {
        this.initialize();
      },
      assignments: [
        {
          status_name: "Pending",
          lab_name: "ED-401",
          assignee: "John Doe",
          report_name: "Wet Lab",
          due_date: "14-Jan-2020"
        },
        {
          status_name: "Review Required",
          lab_name: "ED-401",
          assignee: "John Doe",
          report_name: "Wet Lab",
          due_date: "14-Jan-2020"
        },
        {
          status_name: "Overdue",
          lab_name: "ED-401",
          assignee: "Johnathan Doe",
          report_name: "Wet Lab",
          due_date: "14-Jan-2020"
        },
        {
          status_name: "Pending",
          lab_name: "ED-401",
          assignee: "John Doe",
          report_name: "Wet Lab",
          due_date: "14-Jan-2020"
        },
        {
          status_name: "Submitted",
          lab_name: "ED-310",
          assignee: "John Doe",
          report_name: "Wet Lab",
          due_date: "10-Jul-2020"
        }
      ]
    };
  },
  watch: {
    dialog(val) {
      val || this.close();
    }
  },

  created() {
    this.initialize();
  },
  methods: {
    getColor(status_name) {
      if (status_name == "Pending") return "blue";
      else if (status_name == "Submitted") return "green";
      else if (status_name == "Overdue") return "red";
      else return "grey";
    },
    initialize() {
      this.assignments = [
        {
          status_name: "Submitted",
          lab_name: "ED-310",
          assignee: "John Doe",
          report_name: "Wet Lab",
          due_date: "10-Jul-2020"
        }
      ];
    },
    editItem(item) {
      this.editedIndex = this.assignments.indexOf(item);
      this.editedItem = Object.assign({}, item);
      this.dialog = true;
    },

    deleteItem(item) {
      const index = this.assignments.indexOf(item);
      confirm("Are you sure you want to delete this item?") &&
        this.assignments.splice(index, 1);
    },

    close() {
      this.dialog = false;
      setTimeout(() => {
        this.editedItem = Object.assign({}, this.defaultItem);
        this.editedIndex = -1;
      }, 300);
    },

    save() {
      if (this.editedIndex > -1) {
        Object.assign(this.assignments[this.editedIndex], this.editedItem);
      } else {
        this.assignments.push(this.editedItem);
      }
      this.close();
    }
  }
};
</script>