<template>
  <v-row justify="center">
    <v-snackbar v-model="alert.show" :timeout="alert.timeout" top :color="alert.color">
      {{ alert.text }}
    </v-snackbar>
    <v-card width="80%" class="ma-3" max-width="1000px" v-if="this.active_sctn !=null">
      <v-card-title>
        <div v-if="this.active_sctn.title !=null">{{this.active_sctn.title}}</div>
      </v-card-title>
      <v-data-table
        :headers="headers"
        :items="active_sctn.questions"
        :search="search"
        hide-default-footer
        height="300px"
      >
        <template v-slot:item.answer="{ item }">
          <v-radio-group row v-model="item.answer">
            <v-radio :label="`Yes`"></v-radio>
            <v-radio :label="`No`"></v-radio>
            <v-radio :label="`NA`"></v-radio>
          </v-radio-group>
        </template>

        <template v-slot:item.description="props">
          <v-edit-dialog
            id="bl"
            :return-value.sync="props.item.description"
            large
            persistent
            @save="save"
            @close="close"
          >
            <div>{{ props.item.description }}</div>
            <template v-slot:input>
              <div class="mt-4 title">Update Comment</div>
            </template>
            <template v-slot:input>
              <v-textarea
                v-model="props.item.description"
                :rules="[]"
                label="Comment"
                clearable
                rows="3"
                autofocus
              ></v-textarea>
            </template>
          </v-edit-dialog>
        </template>
      </v-data-table>
      <v-row justify="center">
        <v-col>
          <v-row cols="12" justify="end">
            <v-card-actions class="ma-4">
              <v-btn @click="navigate('assignments')">Cancel</v-btn>
              <v-btn @click="saveInpsection()" color="primary" dark>Save</v-btn>
              <v-btn
              class="ml-5"
                @click="submitInspection('Submitted')"
                color="secondary"
                v-if="master_sctn.status =='Pending'"
              >Submit</v-btn>
              <v-btn
              class="ml-5"
                @click="submitInspection('Complete')"
                color="secondary"
                v-if="master_sctn.status =='Submitted'  ||master_sctn.status=='In Review' "
              >Mark Complete</v-btn>
              <v-btn
              class="ml-5"
                @click="submitInspection('In Review')"
                color="secondary"
                v-if="master_sctn.status =='Submitted'"
              >Set to Review</v-btn>
            </v-card-actions>
          </v-row>
          <v-row cols="12" justify="center">
            <v-card-actions md="12">
              <v-btn small class="ma-2 white--text" color="primary" @click="prevSection()">
                <v-icon dark>mdi-chevron-left</v-icon>
              </v-btn>
              <v-label
                class="pa-2"
              >Section {{this.sctn_index+1}} of {{this.master_sctn.sections.length}}</v-label>
              <v-btn small class="ma-2 white--text" color="primary" @click="nextSection()">
                <v-icon dark>mdi-chevron-right</v-icon>
              </v-btn>
            </v-card-actions>
          </v-row>
        </v-col>
      </v-row>
    </v-card>
  </v-row>
</template>



<script>
export default {
  data() {
    return {
      id: parseInt(window.location.pathname.split("/").pop()), //get this dynamic or from url
      AuthStr: "Bearer " + localStorage.getItem("api"),
      search: "",
      sctn_index: 0,
      dialog: false,
      show: false,
      alert:{
        show: false,
        text:" ",
        timeout :3000,
        color: "black"
      },
      headers: [
        {
          text: "Question",
          align: "left",
          sortable: false,
          value: "question",
          width: "50%"
        },
        { text: "Response", value: "answer", width: "25%", sortable: false },
        {
          text: "Comment",
          value: "description",
          width: "250px",
          sortable: false
        }
      ],
      editedIndex: -1,
      editedItem: {
        description: ""
      },
      defaultItem: {
        description: ""
      },

      master_sctn: null,
      active_sctn: null
    };
  },
  watch: {
    dialog(val) {
      val || this.close();
    }
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
              console.log("Report update done!");
              this.master_sctn = response.data.data;
              this.active_sctn = this.master_sctn.sections[0]; //.questions;
              this.$emit("update-header", this.master_sctn);
            },
            error => {
              console.log("Report update failed!");
              this.setSnack(true,"Failed to retrieve assignment","error" )

            }
          );
      }
    },
    saveInpsection() {
      
      this.setSnack(true,"Saving...","black" )
      axios
        .post("/api/v1/report/" + this.id, this.master_sctn, {
          headers: {
            Authorization: this.AuthStr,
            "Content-Type": "application/json"
          }
        })
        .then(
          response => {
            console.log("Inspection saved!");
            this.master_sctn.sections = response.data.data.sections;
            this.master_sctn.status = response.data.data.status;
            this.$emit("update-header", this.master_sctn);
            this.setSnack(true,"Saved Successfully","success" )
          },
          error => {
            console.log("Inspection save failed!");
            this.setSnack(true,"Something went wrong. Please contact system admin.","error" )

          }
        );
    },
    submitInspection(sts) {
      if (confirm("Are you sure you want to Submit this inspection?")) {
        this.master_sctn.status = sts;
        this.saveInpsection();
      }
    },
    editItem(item) {
      this.editedIndex = this.active_sctn.indexOf(item);
      this.editedItem = Object.assign({}, item);
      this.dialog = true;
    },

    close() {
      this.dialog = false;
      setTimeout(() => {
        this.editedItem = Object.assign({}, this.defaultItem);
        this.editedIndex = -1;
      }, 300);
    },

    save() {
      this.close();
    },
    prevSection() {
      if (this.sctn_index != 0) {
        this.active_sctn = this.master_sctn.sections[this.sctn_index - 1];
        this.sctn_index--;
      }
    },
    nextSection() {
      debugger;
      if (this.sctn_index != this.master_sctn.sections.length - 1) {
        this.active_sctn = this.master_sctn.sections[this.sctn_index + 1];
        this.sctn_index++;
      }
    },
    navigate(point) {
      if (
        confirm(
          "Are you sure you want to leave this page? Any unsaved items will be lost."
        )
      ) {
        window.location.href = "/" + point;
      }
    },
    setSnack(on,txt, col,time){
      this.alert.show = on
      this.alert.text = txt
      this.alert.color= col

    }
  }
};
</script>
<style>
.v-small-dialog__activator {
  border-bottom: 1px solid gray;
}
.inspection-tbl {
  max-height: 40%;
}
</style>