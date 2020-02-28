<template>
    <v-snackbar
      v-model="snackbar"
      :timeout="timeout"
      :top="true"
      :vertical="mode === 'vertical'"
    >
      {{ message }}
      <v-btn
        color="pink"
        flat
        @click="$emit('snackbarClose')"
      >
        Close
      </v-btn>
    </v-snackbar>
</template>
<script>
  export default {
    props: ["message", "snackbar"],
    data () {
      return {
        y: 'top',
        x: null,
        mode: '',
        timeout: 10000
      }
    }
  }
</script>
