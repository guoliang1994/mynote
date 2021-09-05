<template>
  <div class="app-container">
    {{apiUrl}}
    <Upload v-model="form.avatar" :action="apiUrl"/>
  </div>
</template>

<script>
import Upload from '@/components/Upload/SingleImage'

export default {
  components: {
    Upload
  },
  computed: {
    apiUrl() {
      return process.env.VUE_APP_BASE_API + '/api/upload/avatar'
    }
  },
  data() {
    return {
      form: {
        name: '',
        region: '',
        date1: '',
        date2: '',
        delivery: false,
        type: [],
        resource: '',
        desc: '',
        avatar: ''
      }
    }
  },
  methods: {
    onSubmit() {
      this.$message('submit!')
    },
    onCancel() {
      this.$message({
        message: 'cancel!',
        type: 'warning'
      })
    }
  }
}
</script>

<style scoped>
.line{
  text-align: center;
}
</style>

