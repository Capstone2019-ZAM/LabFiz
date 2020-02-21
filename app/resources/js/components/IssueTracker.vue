<template>
  <v-container>
    <v-card>
      <v-card-title class="justify-center">
        <span class="headline">Issue Tracker Form</span>
      </v-card-title>
      <v-divider></v-divider>
      <v-data-table :headers="headers" :items="issues">
        <template v-slot:item.status="{ item }">
          <v-chip :color="getColor(item.status)" dark>{{ item.status }}</v-chip>
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
      AuthStr: 'Bearer '+localStorage.getItem("api"),
      headers: [
        {
          text: "Status",
          align: "left",
          sortable: false,
          value: "status"
        },
        { text: "Issue", value: "title" },
        { text: "Room #", value: "room" },
        { text: "Assigned To", value: "user_id" },
        { text: "Resoluton Date", value: "due_date" },
        { text: "Actions", value: "action", sortable: false, width: "100px" }
      ],
      issues: [
        // {
        //   name: 'Status1',
        //   issue: 33,
        //   room: 'ED 123',
        //   assigned: 'Edward Livingstone',
        //   date: "Jan 02, 2020",
        // }
      ]
    };
  },
  methods: {
    getColor(status_name) {
      if (status_name == "Open") return "red";
      else if (status_name == "Closed") return "blue";
      else return "grey";
    },
    editItem(item) {
      window.location.href = "http://localhost/issue/" + item.id;
    },

    deleteItem(item) {
      const index = this.issues.indexOf(item);
      confirm("Are you sure you want to delete this item?") &&
        this.issues.splice(index, 1);
      // axios.delete("/api/v1/issue/"+item.id, {
      //   headers: { Authorization: this.AuthStr }
      // })
      // .then(
      //   response => {
      //     console.log("delete done!");
      //     this.issues = response.data.data;
      //   },
      //   error => {
      //     console.log("delete failed!");
      //   }
      // );
    },

    addItem() {
      window.location.href = "http://localhost/issue";
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
          this.issues = response.data.data;
        },
        error => {
          console.log("fetch failed!");
        }
      );
  }
};
</script>