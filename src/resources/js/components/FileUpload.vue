<template>
    <div class="content">
        <h1>File Upload</h1>
        <p><input type="file" v-on:change="fileSelected"></p>
        <!-- <button v-on:click="fileUpload">アップロード</button> -->
        <p v-show="showRecipeImage"><img v-bind:src="recipe.file_path"></p>
    </div>
</template>

<script>
export default {
    data: function(){
        return {
          fileInfo: '',
          recipe: '',
          showRecipeImage: false
        }
    },
    methods:{
        fileSelected(event){
            this.fileInfo = event.target.files[0]
        },
        fileUpload(){
            const formData = new FormData()

            formData.append('file',this.fileInfo)

            axios.post('/api/fileupload',formData).then(response =>{
                this.user = response.data
                if(response.data.file_path) this.showRecipeImage = true
            });
        }
    }
}
</script>

<style>
.content{
    margin:5em;
}
</style>