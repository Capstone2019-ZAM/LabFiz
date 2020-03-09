<template>
  <v-container>
    <v-snackbar
      v-model="alert.show"
      :timeout="alert.timeout"
      top
      :color="alert.color"
    >{{ alert.text }}</v-snackbar>
    <v-container justify="center">
      <v-breadcrumbs :items="navlist"></v-breadcrumbs>
    </v-container>
    <v-card>
      <v-card-title class="justify-center">
        <span class="headline">Issue Tracker Form</span>
      </v-card-title>
      <v-divider></v-divider>
      <v-data-table :headers="headers" :items="issues">
        <template v-slot:item.status="{ item }">
          <v-chip :color="getColor(item.status)" dark>{{ item.status }}</v-chip>
        </template>

        <template v-slot:item.title="{ item }">
          <a class="nav" :href="viewLink(item)">{{item.title}}</a>
        </template>
        <template v-slot:item.action="{ item }">
          <v-icon small class="mr-2" @click="editItem(item)">mdi-pencil</v-icon>
          <v-icon small @click="deleteItem(item)">mdi-delete</v-icon>
        </template>
      </v-data-table>
      <v-btn block outlined @click="addItem()">
        Add an Entry
        <v-icon>mdi-plus</v-icon>
      </v-btn>
    </v-card>
  </v-container>
</template>


<script>
export default {
  data() {
    return {
      alert: {
        show: false,
        text: " ",
        timeout: 3000,
        color: "black"
      },
      users: null,
      AuthStr: "Bearer " + localStorage.getItem("api"),
      headers: [
        {
          text: "Status",
          align: "left",
          sortable: false,
          value: "status"
        },
        { text: "Issue", value: "title" },
        { text: "Room #", value: "room" },
        { text: "Assigned To", value: "user_name" },
        { text: "Resoluton Date", value: "due_date" },
        { text: "Actions", value: "action", sortable: false, width: "100px" }
      ],
      issues: [],
      temp_issues: [],
      navlist: [
        {
          text: "Home",
          disabled: false,
          href: "/dashboard"
        },
        {
          text: "All Issues",
          disabled: true,
          href: ""
        }
      ]
    };
  },
  methods: {
    setSnack(on, txt, col, time) {
      this.alert.show = on;
      this.alert.text = txt;
      this.alert.color = col;
    },
    viewLink(i) {
      return "/issue/" + i.id;
    },
    getNamebyId(t_id) {
      let n = this.users.find(x => x.id == t_id);
      return n.first_name + " " + n.last_name;
    },
    getColor(status_name) {
      if (status_name == "Open") return "red";
      else if (status_name == "Closed") return "blue";
      else return "grey";
    },
    editItem(item) {
      window.location.href = "/issue/" + item.id;
    },

    deleteItem(item) {
      const index = this.issues.indexOf(item);
      if (confirm("Are you sure you want to delete this item?")) {
        axios
          .delete("/api/v1/issue/" + item.id, {
            headers: { Authorization:  this.AuthStr }
          })
          .then(
            response => {
              console.log("delete done!");
              //this.issues = response.data.data;
              this.issues.splice(index, 1);
              this.setSnack(true, "Issue Log deleted successfully", "success");
            },
            error => {
              console.log("delete failed!");
              this.setSnack(true, "Issue Log delete failed", "error");
            }
          );
      }
    },

    addItem() {
      window.location.href = "/issue";
    }
  },

  mounted() {
    axios
      .get("/api/v1/issues", {
        headers: { Authorization: this.AuthStr }
      })
      .then(
        response => {
          console.log("fetch done!");
          this.temp_issues = response.data.data;
          return axios.get("/api/users", {
            headers: { Authorization: this.AuthStr }
          });
        },
        error => {
          console.log("fetch failed!");
          this.setSnack(true, "Failed to retrieve issue log", "error");
        }
      )
      .then(
        response => {
          console.log("user fetch done!");
          this.users = response.data.data;
          this.temp_issues.map(iss => {
            iss.user_name = this.getNamebyId(iss.assigned_to);
          });
          this.issues = this.temp_issues;
          this.loading = false;
        },
        error => {
          console.log("user fetch failed!");
          this.loading = false;
        }
      );
  }
};
</script>