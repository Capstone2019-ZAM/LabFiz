<template>
<v-row cols="12" align="start" justify="center">
  <v-col md="9">
  <v-container class="pa5" >

    <v-row cols="12" >

        <v-col md="4"  sm="12" v-for="data in options" :key="data.id">
          <dash-button :data="data"></dash-button>
        </v-col>

    </v-row>
  </v-container>
  </v-col>
</v-row>
</template>

<script>
import DashButton from "./DashButton";

export default {
  components: {
    "dash-button": DashButton
  },
  data() {
    return {
      AuthStr: 'Bearer '+localStorage.getItem("api"),
      loading :true,
      options: null
     };
  },

  mounted(){
     this.loading = true;
      axios.get("/api/v1/dashboard",
      {
        headers: { Authorization: this.AuthStr }})
      .then((response)  =>  {
        console.log('fetch done!')
        this.options = response.data.data;
        this.loading = true;
      }, (error)  =>  {
        this.loading = false;
    })
  }
};
</script>

