<template>
  <div >
    <v-container justify="center" >
     <v-breadcrumbs :items="navlist"></v-breadcrumbs>
    </v-container>
    <assignment-header :data="this.section_header"></assignment-header>
    <assignment-section></assignment-section>
  </div>
</template>

<script>
import AssignmentHeader from "./AssignmentHeader";
import AssignmentSection from "./AssignmentSection";
export default {
  components: {
    "assignment-header": AssignmentHeader,
    "assignment-section": AssignmentSection
  },
  data() {
    return {
      id: parseInt(window.location.pathname.split("/").pop()), //get this dynamic or from url
      AuthStr: "Bearer " + localStorage.getItem("api"),
      section_header: null,
      navlist:[
        {
          text: 'Home',
          disabled: false,
          href: '/dashboard',
        },
        {
          text: 'All Assignments',
          disabled: false,
          href: '/assignments',
        },
        {
          text: 'Assignment',
          disabled: true,
          href: '',
        },
      ],
    };
  },
  created() {
    this.initialize();
  },
  methods: {
    initialize() {
      if (Number.isInteger(this.id)) {
        axios
          .get("/api/v1/report/" + this.id, {
            headers: { Authorization: this.AuthStr }
          })
          .then(
            response => {
              console.log("fetch done!");
              this.section_header = response.data.data;
            },
            error => {
              console.log("fetch failed!");
            }
          );

      }
    }
  }
};
</script>