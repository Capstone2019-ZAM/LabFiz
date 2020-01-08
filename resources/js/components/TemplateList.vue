<template>
  <v-list  tile>
    <v-list-item>
      <v-card class="mx-auto" width="80%">
        <v-card-title>Report Templates</v-card-title>
        <v-list two-line subheader>

          <v-list-item v-for="item in items" :key="item.title" @click>
            <v-list-item-avatar>
              <v-icon :class="[item.iconClass]" v-text="item.icon"></v-icon>
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
        <v-spacer></v-spacer>

        <v-btn block outlined color="indigo" class="ma-10">
          Add new Template
          <v-icon dark>mdi-plus</v-icon>
        </v-btn>
      </v-card>
    </v-list-item>
  </v-list>
</template>
<script>
export default {
  data: () => ({
    items: [
      {
        icon: "mdi-clipboard-text",
        iconClass: "grey lighten-1 white--text",
        title: "Wet Labaratory",
        subtitle: "Jan 9, 2014"
      },
      {
        icon: "mdi-clipboard-text",
        iconClass: "grey lighten-1 white--text",
        title: "Dry Labs",
        subtitle: "Jan 17, 2014"
      },
      {
        icon: "mdi-clipboard-text",
        iconClass: "grey lighten-1 white--text",
        title: "Software Labs",
        subtitle: "Jan 28, 2014"
      }
    ]
  })
};
</script>