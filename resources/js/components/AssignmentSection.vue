<template>
  <!-- <v-card>
    <v-row>
      <v-col cols="12" md="5">
        <v-card-text>Question Here</v-card-text>
      </v-col>
      <v-col cols="12" md="3">
           <v-radio-group column="false" row="true">
          <v-radio
            v-for="n in 3"
            :key="n"
            :label="` ${n}`"
            :value="n"
          ></v-radio>
        </v-radio-group>
      </v-col>
      <v-col cols="12" md="3">
        <v-text-field></v-text-field>
      </v-col>
    </v-row>
  </v-card>-->
  <v-card>
    <v-card-title>Section Title</v-card-title>
    <v-data-table :headers="headers" :items="sec_q" :search="search">
      <template v-slot:item.answer="{ item }">
        <!-- <v-chip :color="getColor(item.status_name)" dark>{{ item.status_name }}</v-chip> -->
        <v-radio-group row>
          <v-radio v-for="n in 3" :key="n" :label="` |`" :value="n"></v-radio>
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
            <v-text-field
              v-model="props.item.comment"
              :rules="[]"
              label="Comment"
              single-line
              counter
              autofocus
            ></v-text-field>
          </template>
        </v-edit-dialog>
      </template>
    </v-data-table>
  </v-card>
</template>



<script>
export default {
  data() {
    return {
      search: "",
      dialog: false,
      headers: [
        {
          text: "Question",
          align: "left",
          sortable: false,
          value: "question",
          width: "50%"
        },
        { text: "Answer", value: "answer", width: "20%", sortable: false },
        { text: "Comment", value: "comment", width: "30%", sortable: false }
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
      sec_q: [
        {
          question: "How do you do?"
        },
        {
          question: "What is your age?"
        },
        {
          question:
            "Did you clean ur room?Did you clean ur roomDid you clean ur roomDid you clean ur roomDid you clean ur roomDid you clean ur roomDid you clean ur roomDid you clean ur roomDid you clean ur roomDid you clean ur roomDid you clean ur roomDid you clean ur roomDid you clean ur room"
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
      this.sec_q = [
        {
          question: "Did you clean ur room?Did",
          comment: "Nada"
        },
        {
          question: "What is your age?",
          comment: "Nada"
        },
        {
          question: "Did you clean ur room?",
          comment: "Nada"
        }
      ];
    },
    editItem(item) {
      debugger
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
      // if (this.editedIndex > -1) {
      //   Object.assign(this.sec_q[this.editedIndex], this.editedItem);
      // } else {
      //   this.sec_q.push(this.editedItem);
      // }
      this.close();
    }
  }
};
</script>