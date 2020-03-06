<template>
  <v-row justify="center">
    <v-card width="80%" class="ma-3" max-width="1000px" v-if="this.active_sctn !=null">
      <v-card-title>{{this.active_sctn.title}}</v-card-title>
      <v-data-table :headers="headers" :items="active_sctn" :search="search" hide-default-footer >
        <template v-slot:item.answer="{ item }" >
          <v-radio-group row v-model="item.answer">
            <v-radio :label="`Yes`"></v-radio>
            <v-radio :label="`No`"></v-radio>
            <v-radio :label="`NA`"></v-radio>
          </v-radio-group>
        </template>

        <template v-slot:item.comment="props"  >
          <v-edit-dialog
            id="bl"
            :return-value.sync="props.item.comment"
            large
            persistent
            @save="save"
            @close="close"
          >
            <div>{{ props.item.comment }}</div>
            <template v-slot:input>
              <div class="mt-4 title">Update Comment</div>
            </template>
            <template v-slot:input>
              <v-textarea
                v-model="props.item.comment"
                :rules="[]"
                label="Comment"
                clearable
                rows=3
                autofocus
              ></v-textarea>
            </template>
          </v-edit-dialog>
        </template>
      </v-data-table>
      <v-row justify="center">
        <v-card-actions>
          <v-btn small class="ma-2 white--text" fab color="primary" @click="prevSection()">
            <v-icon dark>mdi-arrow-left-thick</v-icon>
          </v-btn>
          <v-label>Section # 1</v-label>
          <v-btn small class="ma-2 white--text" fab color="primary" @click="nextSection()">
            <v-icon dark>mdi-arrow-right-thick</v-icon>
          </v-btn>
        </v-card-actions>
      </v-row>
    </v-card>
  </v-row>
</template>



<script>
export default {
  data() {
    return {
      id: parseInt( window.location.pathname.split("/").pop()), //get this dynamic or from url
      AuthStr: "Bearer " + localStorage.getItem("api"),
      search: "",
      sctn_index: 0,
      dialog: false,
      headers: [
        {
          text: "Question",
          align: "left",
          sortable: false,
          value: "question",
          width: "50%"
        },
        { text: "Response", value: "answer", width: "25%", sortable: false },
        { text: "Comment", value: "comment", width: "250px", sortable: false }
      ],
      editedIndex: -1,
      editedItem: {
        comment: ""
      },
      defaultItem: {
        comment: ""
      },
   
      master_sctn: null,
      active_sctn: null,        
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
              console.log("fetch done!");
              this.master_sctn = response.data.data;
              this.active_sctn = this.master_sctn.sections[0].questions;
            },
            error => {
              console.log("fetch failed!");
            }
          );
      }

      // this.active_sctn = [
      //   {
      //     question: "Did you clean ur room?Did",
      //     answer: 1,
      //     comment: "Nada0"
      //   },
      //   {
      //     question: "What is your age?",
      //     answer: 2,
      //     comment: "Nada1"
      //   },
      //   {
      //     question: "Did you clean ur room?",
      //     answer: 0,
      //     comment: "Nada2"
      //   }
      // ];
      
    },

    submitInspection() {
      axios
        .post("/api/v1/report/" + this.id, this.master_sctn, {
          headers: {
            Authorization: this.AuthStr,
            "Content-Type": "application/json"
          }
        })
        .then(
          response => {
            console.log("post done!");
            this.issues = response.data.data;
          },
          error => {
            console.log("post failed!");
          }
        );
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
        this.active_sctn = this.master_sctn[this.sctn_index - 1];
        this.sctn_index--;
      }
    },
    nextSection() {
      if (this.sctn_index != this.master_sctn.length - 1) {
        this.active_sctn = this.master_sctn[this.sctn_index + 1];
        this.sctn_index++;
      }
    }
  }
};
</script>
<style>
.v-small-dialog__activator{
 border-bottom: 1px solid gray  
}
</style>