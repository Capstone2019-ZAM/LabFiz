<template>
  <v-container>
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
  }
};
</script>