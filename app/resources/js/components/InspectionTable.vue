<template>
  <v-row justify="center">
    <v-col cols="12" md="12" lg="9">
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
        <v-data-table
          :headers="headers"
          :items="reports"
          :search="search"
          :loading="loading"
          loading-text="Loading... Please wait"
        >
          <template v-slot:item.status="{ item }">
            <v-chip :color="getColor(item.status)" dark>{{ item.status }}</v-chip>
          </template>

          <!-- <v-card>
            <v-card-title>
              <span class="headline">Edit Assignment</span>
            </v-card-title>

            <v-card-text>
              <v-container>
                <v-row>
                  <v-col cols="12" sm="6" md="4">
                    <v-text-field v-model="editedItem.status" label=""></v-text-field>
                  </v-col>
                </v-row>
              </v-container>
            </v-card-text>

            <v-card-actions>
              <v-spacer></v-spacer>
              <v-btn color="blue darken-1" text @click="close">Cancel</v-btn>
              <v-btn color="blue darken-1" text @click="save">Save</v-btn>
            </v-card-actions>
          </v-card>-->

          <!-- <v-dialog v-model="dialog" max-width="500px"> -->
          <template v-slot:item.title="{ item }">
            <a class="nav" :href="viewLink(item)">{{item.title}}</a>
          </template>

          <template v-slot:item.action="{ item }">
            <!-- <v-icon small class="mr-2" @click="editItem(item)">mdi-pencil</v-icon> -->
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
      loading: false,
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

        { text: "Report", value: "title", width: "150px" },
        { text: "Assigned To", value: "user_name", width: "150px" },
        { text: "Due Date", value: "due_date", width: "100px" },
        { text: "Actions", value: "action", sortable: false, width: "50px" }
      ],
      defaultItem: {
        // report: "",
        // room: "",
        // status: "",
        // assigned_to: ""
      },
      temp_reports: [],
      reports: [
        // {
        //   status: "Pending",
        //   lab: "ED-401",
        //   user_name: "John Doe",
        //   user_id: 1,
        //   title: "Wet Lab",
        //   due_date: "14-Jan-2020"
        // }
      ]
    };
  },
  watch: {
    dialog(val) {
      val || this.close();
    }
  },
  computed: {},
  created() {
    this.initialize();
  },
  methods: {
    getNamebyId(t_id) {
      let n = this.users.find(x => x.id == t_id);
      return n.first_name + " " + n.last_name;
    },
    viewLink(i) {
      return "/assignment/" + i.id;
    },
    getColor(status) {
      if (status == "Pending") return "blue";
      else if (status == "Submitted") return "green";
      else if (status == "Overdue") return "red";
      else return "grey";
    },
    initialize() {
      (this.loading = true),
        axios
          .get("/api/v1/reports", {
            headers: { Authorization: "Bearer " + this.AuthStr }
          })
          .then(
            response => {
              console.log("reports fetch done!");
              this.temp_reports = response.data.data;
              this.loading = false;
              return axios.get("/api/users", {
                headers: { Authorization: "Bearer " + this.AuthStr }
              });
            },
            error => {
              this.loading = false;
              console.log("reports fetch failed!");
            }
          )
          .then(
            response => {
              console.log("user fetch done!");
              this.users = response.data.data;
              this.temp_reports.map(rpt => {
                rpt.user_name = this.getNamebyId(rpt.assigned_to);
              });
              this.reports = this.temp_reports;
              this.loading = false;
            },
            error => {
              console.log("user fetch failed!");
              this.loading = false;
            }
          );
    },
    editItem(item) {
      // this.editedIndex = this.reports.indexOf(item);
      // this.editedItem = Object.assign({}, item);
      // this.dialog = true;
    },

    deleteItem(item) {
      const index = this.reports.indexOf(item);
      this.loading = true;
      confirm("Are you sure you want to delete this item?") &&
        axios
          .delete("/api/v1/report/" + item.id, {
            headers: { Authorization: "Bearer " + this.AuthStr }
          })
          .then(
            response => {
              console.log("Inspection instance deleted!");
              this.reports.splice(index, 1);
              this.loading = false;
            },
            error => {
              console.log("Inspection delete failed!");
              this.loading = false;
            }
          );
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