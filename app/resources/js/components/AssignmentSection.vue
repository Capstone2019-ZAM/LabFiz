<template>
  <v-row justify="center">
    <v-card width="80%" class="ma-3" max-width="1000px">
      <v-card-title>Section Title</v-card-title>
      <v-data-table :headers="headers" :items="sec_q" :search="search" hide-default-footer>
        <template v-slot:item.answer="{ item }">
          <v-radio-group row v-model="item.answer">
            <v-radio :label="`Yes`"></v-radio>
            <v-radio :label="`No`"></v-radio>
            <v-radio :label="`NA`"></v-radio>
          </v-radio-group>
        </template>

        <template v-slot:item.comment="props">
          <v-edit-dialog
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
                counter
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
      AuthStr: 'Bearer '+localStorage.getItem("api"),
      search: "",
      sctn_index:0,
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
        { text: "Comment", value: "comment", width: "25%", sortable: false }
      ],
      editedIndex: -1,
      editedItem: {
        comment: ""
      },
      defaultItem: {
        comment: ""
      },
      created() {
        this.initialize();
      },
      master_sctn:Array(),
      sec_q: [
        {
          question: "How do you do?",
          answer: 1
        }
      ]
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
      //  axios
      // .get("/api/v1/report", {
      //   headers: { Authorization: this.AuthStr }
      // })
      // .then(
      //   response => {
      //     console.log("fetch done!");
      //     this.master_sctn = response.data.data;
      //   },
      //   error => {
      //     console.log("fetch failed!");
      //   }
      // );


      this.sec_q = [
        {
          question: "Did you clean ur room?Did",
          answer: 1,
          comment: "Nada0"
        },
        {
          question: "What is your age?",
          answer: 2,
          comment: "Nada1"
        },
        {
          question: "Did you clean ur room?",
          answer: 0,
          comment: "Nada2"
        }
      ];
      this.master_sctn.push( this.sec_q);
    },

    submitInspection(){
    
    axios
      .post("/api/v1/report/"+this.id,this.master_sctn, {
        headers: { Authorization: this.AuthStr, "Content-Type": "application/json"}
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
      debugger;
      this.editedIndex = this.sec_q.indexOf(item);
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
    prevSection(){
      debugger
      if ( this.sctn_index != 0){
      this.sec_q = this.master_sctn[this.sctn_index -1];
      this.sctn_index--;
      }
    },
    nextSection(){
      if ( this.sctn_index != (this.master_sctn.length -1)  ){
      this.sec_q = this.master_sctn[this.sctn_index +1];
      this.sctn_index++;
      }
    }
  }
};
</script>