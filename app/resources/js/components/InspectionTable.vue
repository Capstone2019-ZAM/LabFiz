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
        <v-data-table :headers="headers" :items="reports" :search="search">
          <template v-slot:item.status="{ item }">
            <v-chip :color="getColor(item.status)" dark>{{ item.status }}</v-chip>
          
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
      AuthStr: localStorage.getItem("api"),
      dialog: false,
      users: null,
      headers: [
        {
          text: "Lab",
          align: "left",
          sortable: true,
          value: "lab",
          width: "100px"
        },
        { text: "Status", value: "status", width: "100px" },

        { text: "Report", value: "title", width: "200px" },
        { text: "Assigned To", value: "user_name", width: "150px" },
        { text: "Due Date", value: "due_date", width: "100px" },
        { text: "Actions", value: "action", sortable: false, width: "50px" }
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
      reports: [
    
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
    getColor(status) {
      if (status == "Pending") return "blue";
      else if (status == "Submitted") return "green";
      else if (status == "Overdue") return "red";
      else return "grey";
    },
    initialize() {

      axios
      .get("/api/v1/reports" , {
        headers: { Authorization:'Bearer '+ this.AuthStr }
      })
      .then(
        response => {
          console.log("reports fetch done!");
          this.reports = response.data.data
          
        },
        error => {
          console.log("reports fetch failed!");
          this.loading = false;
          this.NetError = true;
        }
      );
            axios
      .get("/api/users" , {
        headers: { Authorization:'Bearer '+ this.AuthStr }
      })
      .then(
        response => {
          console.log("user fetch done!");
          this.users = response.data.data
          debugger
        },
        error => {
          console.log("user fetch failed!");
          this.loading = false;
          this.NetError = true;
        }
      );

      // this.reports = [
      //       {
      //     status: "Pending",
      //     lab: "ED-401",
      //     user_name: "John Doe",
      //     title: "Wet Lab",
      //     due_date: "14-Jan-2020"
      //   },
      //   {
      //     status: "Review Required",
      //     lab: "ED-401",
      //     user_name: "John Doe",
      //     title: "Wet Lab",
      //     due_date: "14-Jan-2020"
      //   },
      //   {
      //     status: "Overdue",
      //     lab: "ED-401",
      //     user_name: "Johnathan Doe",
      //     title: "Wet Lab",
      //     due_date: "14-Jan-2020"
      //   },
      //   {
      //     status: "Pending",
      //     lab: "ED-401",
      //     user_name: "John Doe",
      //     title: "Wet Lab",
      //     due_date: "14-Jan-2020"
      //   },
      //   {
      //     status: "Submitted",
      //     lab: "ED-310",
      //     user_name: "John Doe",
      //     title: "Wet Lab",
      //     due_date: "10-Jul-2020"
      //   }
      // ];
    },
    editItem(item) {
      this.editedIndex = this.reports.indexOf(item);
      this.editedItem = Object.assign({}, item);
      this.dialog = true;
    },

    deleteItem(item) {
      const index = this.reports.indexOf(item);
      confirm("Are you sure you want to delete this item?") &&
        this.reports.splice(index, 1);
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
        Object.assign(this.reports[this.editedIndex], this.editedItem);
      } else {
        this.reports.push(this.editedItem);
      }
      this.close();
    }
  }
};
</script>