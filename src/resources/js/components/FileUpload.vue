<template>
  <div class="container">
    <div class="large-12 medium-12 small-12 cell">
      <label>File
        <input type="file" id="file" ref="file" v-on:change="onFileChange"/>
      </label>
        <button v-on:click="submitFile()">Submit</button>
        <img :src="url" v-show="url">
    </div>
 
  </div>
</template>
<script>
  const axios = require('axios')
    export default {
    data(){
      return {
        file: '',
        url: ''
      }
    },    
    methods: {
      submitFile(){
        let formData = new FormData();
        formData.append('file', this.file);
        axios.post( 'http://localhost:8000/post.php',
          formData,
          {
            headers: {
              'Content-Type': 'multipart/form-data'
            }
          }
        ).then(function() {
          console.log('Success!!')
        }).catch(function() {
          console.log('Failed！')
        })
      },      
      onFileChange(e){
        this.file = e.target.files[0]
        this.url = URL.createObjectURL(this.file)
      }
    }
  }
</script>