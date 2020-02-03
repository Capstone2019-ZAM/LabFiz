<template>
  <v-container>

    <v-row>
      <div  v-for="data in options" :key="data.id">
        <v-col>
          <dash-button :data="data"></dash-button>
        </v-col>
      </div>
    </v-row>
  </v-container>
</template>

<script>
import DashButton from "./DashButton";
// import axios from 'axios';

export default {
  components: {
    "dash-button": DashButton
  },
  data() {
    return {
      loading :true,
      options: null
      // [
        // {
        //   icon: "mdi-file-document-edit",
        //   title: "Assign Inspections",
        //   description: "Something said here"
        // },
        // {
        //   icon: "mdi-account-card-details",
        //   title: "Account Managment",
        //   description: "Something said here"
        // },
        // {
        //   icon: "mdi-clipboard-text-multiple",
        //   title: "Templates",
        //   description: "Something said here"
        // },
        // {
        //   icon: "mdi-bug",
        //   title: "Issue Tracker",
        //   description: "Something said here"
        // },
        // {
        //   icon: "mdi-timetable",
        //   title: "Pending Inspections",
        //   description: "Something said here"
        // }
      //]
    };
  },

  mounted(){
     this.loading = true;
      axios.get("http://localhost/api/v1/dashboard")
      .then((response)  =>  {
        console.log('fetch done!')
        this.options = response.data;
        this.loading = true;
            console.log(this.options);

      }, (error)  =>  {
        this.loading = false;
    })
  }
};
</script>

