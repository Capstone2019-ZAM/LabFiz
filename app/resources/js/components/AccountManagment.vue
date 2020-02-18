<template>
  <div id="app">
    <v-row cols="12" align="center" justify="center">
      <v-col md="6" sm="11" lg="4">
        <v-form v-model="valid">
          <v-card outlined>
            <v-card-title class="justify-center">
              <span class="headline">Create New Account</span>
            </v-card-title>
            <v-divider></v-divider>
            <v-card-text>
              <v-container>
                <v-row>
                  <v-col cols="12" sm="12" md="6">
                    <v-text-field
                      v-model="first_name"
                      label="First Name"
                      :rules="NameRules"
                      clearable
                      outlined
                    ></v-text-field>
                  </v-col>
                  <v-col cols="12" sm="12" md="6">
                    <v-text-field
                      v-model="last_name"
                      label="Last Name"
                      :rules="NameRules"
                      clearable
                      outlined
                    ></v-text-field>
                  </v-col>
                </v-row>
                <v-row align="center" justify="center">
                  <v-col cols="12" sm="12" md="6">
                    <v-select
                      :items="roles"
                      item-text="name"
                      item-value="auth_type"
                      v-model="role"
                      label="Role"
                      outlined
                    ></v-select>
                  </v-col>
                  <v-col cols="12" sm="12" md="6">
                    <v-select :items="departments" v-model="department" label="Department" outlined></v-select>
                  </v-col>
                </v-row>
                <v-row cols="12">
                  <v-col md="12">
                    <v-text-field
                      v-model="email"
                      label="Email"
                      :rules="emailRules"
                      clearable
                      outlined
                    ></v-text-field>
                  </v-col>
                </v-row>
                <v-row align="center" justify="center">
                  <v-btn color="primary" @click="createUser()">
                    <v-icon>mdi-account-circle</v-icon>Create Account
                  </v-btn>
                </v-row>
              </v-container>
            </v-card-text>
          </v-card>
        </v-form>
      </v-col>
    </v-row>
  </div>
</template>
<script>
export default {
  data: () => ({
    AuthStr: localStorage.getItem("api"),
    dialog: false,
    id: window.location.pathname.split("/").pop(),
    valid: false,
    first_name: "",
    last_name: "",
    role: "",
    department: "",
    email: "",
    NameRules: [v => !!v || "Name is Required"],
    email: "",
    emailRules: [
      v => !!v || "E-mail is required",
      v => /.+@.+/.test(v) || "E-mail must be valid"
    ],
    roles: [
      {
        name: "Safety Coordinator",
        auth_type: "admin"
      },
      {
        name: "Inspector",
        auth_type: "inspector"
      },
      {
        name: "Student",
        auth_type: "student"
      }
    ],
    departments: [
      "Software",
      "Electronics",
      "Industrial",
      "Environment",
      "Petroleum",
      "Process Systems",
      "Undergrad Student (RESS)",
      "Grad Student (UREGSA)",
      "Health, Safety & Wellness Consultant",
      "EYES",
      "Engineering Workshop",
      "Others"
    ]
  }),
  methods: {
    createUser() {
      let req = new Object();
      req.first_name = this.first_name;
      req.last_name = this.last_name;
      req.department = this.department;
      req.email = this.email;
      req.role = this.role;
      req.password =  Math.random().toString(36).substring(2, 10) + Math.random().toString(36).substring(2, 10);

      if (
        Number.isInteger(parseInt(window.location.pathname.split("/").pop()))
      ) {
        axios
          .post("/api/user/"+ this.id, req, {
            headers: {
              Authorization: this.AuthStr,
              "Content-Type": "application/json"
            }
          })
          .then(
            response => {
              console.log("User account updated!");
            },
            error => {
              console.log("User account update failed !");
            }
          );
      } else {
        axios
          .post("/api/user/register" , req, {
            headers: {
              Authorization: this.AuthStr,
              "Content-Type": "application/json"
            }
          })
          .then(
            response => {
              console.log("User account created!");
            },
            error => {
              console.log("User account creation failed !");
            }
          );
      }
    }
  },
    mounted() {
    if (
        Number.isInteger(parseInt(window.location.pathname.split("/").pop()))
      ) {
          axios
          .get("/api/user/" + this.id, req, {
            headers: {
              Authorization: this.AuthStr,              
            }
          })
          .then(
            response => {
                  dialog: true
              console.log("User account retrieved!");
                this.first_name = response.data.data.first_name;
                this.last_name= response.data.data.last_name;
                this.department= response.data.data.department;
                this.email= response.data.data.email;
                this.role= response.data.data.role;
            },
            error => {
                  dialog: true,
              console.log("User account update retrieved!");
            }
          );
      
      } 
    
    }
};
</script>