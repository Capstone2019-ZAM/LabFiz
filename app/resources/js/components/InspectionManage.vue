<template>
  <v-container>
     <v-container justify="center" >
     <v-breadcrumbs :items="navlist"></v-breadcrumbs>
    </v-container>
    <inspection-form></inspection-form>
    <inspection-table></inspection-table>
  </v-container>
</template>
<script>
import InspectionForm from "./InspectionForm";
import InspectionTable from "./InspectionTable";
export default {
  components: {
    "inspection-form": InspectionForm,
    "inspection-table": InspectionTable
  },
  data(){
    return {
      navlist:[
        {
          text: 'Home',
          disabled: false,
          href: '/dashboard',
        },
        {
          text: 'All Assignments',
          disabled: true,
          href: '/assignments',
        },
      ],

    }
  }
};
</script>