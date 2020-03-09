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
        <span class="headline">Account Tracker</span>
      </v-card-title>
      <v-divider></v-divider>
      <v-data-table :headers="headers" :items="items">
        <template v-slot:item.action="{ item }">
          <v-icon small class="mr-2" @click="editItem(item)">mdi-pencil</v-icon>
          <v-icon small @click="deleteItem(item)">mdi-delete</v-icon>
        </template>
      </v-data-table>
      <v-btn block outlined @click="addAccount()">
        <v-icon>mdi-plus</v-icon>Add an Entry
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
      AuthStr: localStorage.getItem("api"),
      headers: [
        {
          text: "First Name",
          align: "left",
          sortable: false,
          value: "first_name"
        },
        { text: "Last Name", value: "last_name" },
        { text: "Role", value: "role" },
        { text: "Department", value: "department" },
        { text: "Email", value: "email" },
        { text: "Added Date", value: "created_at" },
        { text: "Actions", value: "action", sortable: false, width: "100px" }
      ],
      items: [
        {
          id: 1,
          first_name: "Robert",
          last_name: "Junior",
          role: "Inspector",
          department: "Engineering",
          email: "est@test.com",
          created_at: null
        }
      ],
      navlist: [
        {
          text: "Home",
          disabled: false,
          href: "/dashboard"
        },
        {
          text: "All Accounts",
          disabled: true,
          href: ""
        }
      ]
    };
  },
  methods: {
    addAccount() {
      window.location.href = "/account";
    },
    editItem(item) {
      window.location.href = "/account/" + item.id;
    },
    setSnack(on, txt, col, time) {
      this.alert.show = on;
      this.alert.text = txt;
      this.alert.color = col;
    },
    deleteItem(item) {
      this.setSnack(true, "Account deleted successfully", "success");

    }
  },
  mounted() {
    axios
      .get("/api/users", {
        headers: { Authorization: "Bearer " + this.AuthStr }
      })
      .then(
        response => {
          console.log("fetch done!");
          this.items = response.data.data;
          //TODO : Add map to get name of role from roles
        },
        error => {
          console.log("fetch failed!");
        }
      );
  }
};
</script>