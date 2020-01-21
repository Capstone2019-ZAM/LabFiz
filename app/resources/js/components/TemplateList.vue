<template>
<v-row  justify="center"  >
  <v-col cols="12" md="12">
      <v-card class="mx-auto" width="80%">
        <v-card-title>Report Templates</v-card-title>
        <v-list two-line subheader >

          <v-list-item v-for="item in items" :key="item.title" @click>
            <v-list-item-avatar>
              <v-icon :class="iconClass" v-text="icon"></v-icon>
            </v-list-item-avatar>

            <v-list-item-content>
              <v-list-item-title v-text="item.title"></v-list-item-title>
              <v-list-item-subtitle v-text="item.subtitle"></v-list-item-subtitle>
            </v-list-item-content>

            <v-list-item-action>
              <v-btn icon>
                <v-icon color="grey lighten-1">mdi-information</v-icon>
              </v-btn>
            </v-list-item-action>
          </v-list-item>
        </v-list>

        <v-btn block outlined color="indigo" class="ma-10">
          Add new Template
          <v-icon dark>mdi-plus</v-icon>
        </v-btn>
      </v-card>
  </v-col>
</v-row>
</template>
<script>
export default {
  data (){
    return {
    AuthStr : localStorage.getItem('api'),
    loading :true,
    icon: "mdi-clipboard-text",
    iconClass: "grey lighten-1 white--text",
    items: null//[
      // {
      //   icon: "mdi-clipboard-text",
      //   iconClass: "grey lighten-1 white--text",
      //   title: "Wet Labaratory",
      //   subtitle: "Jan 9, 2014"
      // },
      // {
      //   icon: "mdi-clipboard-text",
        
      //   title: "Dry Labs",
      //   subtitle: "Jan 17, 2014"
      // },
      // {
      //   icon: "mdi-clipboard-text",
      //   iconClass: "grey lighten-1 white--text",
      //   title: "Software Labs",
      //   subtitle: "Jan 28, 2014"
      // }
  //  ]
    }
  }
  ,
    mounted(){
     this.loading = true;
    //  console.log('Auth '+AuthStr)
      axios.get("http://localhost/api/v1/reports" , { headers: { Authorization: this.AuthStr } })
      .then((response)  =>  {
        console.log('fetch done!')
        this.options = response.data;
        this.loading = true;
            console.log(this.options);

      }, (error)  =>  {
                console.log('fetch failed!')

        this.loading = false;
    })
  }
};
</script>