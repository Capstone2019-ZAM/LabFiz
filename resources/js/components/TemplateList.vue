<template>
    <div id="">
    <v-card
      max-width="600"
      class="mx-auto"
    >
  
     <v-list two-line subheader>
  
        <v-list-item
          v-for="item in items"
          :key="item.title"
          @click=""
        >
          <v-list-item-avatar>
            <v-icon
              :class="[item.iconClass]"
              v-text="item.icon"
            ></v-icon>
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
    </v-card>
    <v-spacer></v-spacer>
  
  <v-card
      max-width="600"
      class="mx-auto text-center"
    >
   <v-btn class="mx-2" fab dark color="indigo">
      <v-icon dark>mdi-plus</v-icon>
    </v-btn>
  </v-card>
</div>
</template>
<script>
export default {
      data: () => ({
    items: [
      { icon: 'mdi-folder', iconClass: 'grey lighten-1 white--text', title: 'Wet Labs', subtitle: 'Jan 9, 2014' },
      { icon: 'mdi-folder', iconClass: 'grey lighten-1 white--text', title: 'Dry Labs', subtitle: 'Jan 17, 2014' },
      { icon: 'mdi-folder', iconClass: 'grey lighten-1 white--text', title: 'Software Labs', subtitle: 'Jan 28, 2014' },
    ]
  }),
}
</script>