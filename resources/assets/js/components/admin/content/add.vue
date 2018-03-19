<template>
    <div style="margin:3rem;">
        <el-form ref="form" :model="post" label-width="80px">
            <el-form-item label="标题">
                <el-input v-model="post.title"></el-input>
            </el-form-item>
            <el-form-item label="封面">
                <el-upload
                        class="avatar-uploader"
                        ref="upload"
                        name="file"
                        accept="jpg,png"
                        :headers="header"
                        :action="host+'/api/uploadImg'"
                        :show-file-list="false"
                        :multiple="false"
                        :on-success="handleAvatarSuccess"
                        :before-upload="beforeAvatarUpload">
                    <img v-if="imageUrl" :src="imageUrl" class="avatar">
                    <i v-else class="el-icon-plus avatar-uploader-icon"></i>
                </el-upload>
            </el-form-item>
            {{imageUrl}}
            <el-form-item label="描述">
                <el-input v-model="post.abs"></el-input>
            </el-form-item>

            <el-form-item label="正文">
                <vue-editor v-model="post.content"></vue-editor>
            </el-form-item>

            <el-form-item>
                <el-button type="primary" @click="onSubmit">提交</el-button>
                <el-button>返回</el-button>
            </el-form-item>
        </el-form>
    </div>
</template>
<style>
    .avatar-uploader .el-upload {
        border: 1px dashed #d9d9d9;
        border-radius: 6px;
        cursor: pointer;
        position: relative;
        overflow: hidden;
    }
    .avatar-uploader .el-upload:hover {
        border-color: #409EFF;
    }
    .avatar-uploader-icon {
        font-size: 28px;
        color: #8c939d;
        width: 178px;
        height: 178px;
        line-height: 178px;
        text-align: center;
    }
    .avatar {
        width: 178px;
        height: 178px;
        display: block;
    }
</style>
<script>
    import { VueEditor } from 'vue2-editor'
    let csrf = document.querySelector('meta[name="csrf-token"]').getAttribute('content')
    export default{
        data () {
            return{
                msg:this.$route.name,
                imageUrl: '',
                host:window.host,
                header:{
                    'X-CSRF-TOKEN': csrf
                },
                post:{
                    title:'',
                    content:'',
                    abs:'' ,
                    img:''
                },

            }
        },
        components: {
            VueEditor
        },
        mounted(){

        },
        methods:{
            onSubmit:function(){
                if(!this.post.title){
                    this.$message.error('请输入文章标题！')
                    return false;
                }
                if(!this.post.content){
                    this.$message.error('文章内容不能为空！')
                    return false;
                }
                if(!this.post.img){
                    this.$message.error('请上传封面图片！')
                    return false;
                }
                let t = this
                this.$ajax.post(window.host+'/api/addPost',t.post).then((res)=>{
                    console.log(res.data)
                },(res)=>{})
            },
            handleAvatarSuccess:function (res,file) {
                this.imageUrl = URL.createObjectURL(file.raw);
                console.log(res)
            },
            beforeAvatarUpload(file) {
                console.log(file)
                const isJPG = file.type === 'image/jpeg';
                const isLt1M = file.size / 1024 / 1024 < 1;
                if (!isJPG) {
                    this.$message.error('上传头像图片只能是 JPG 格式!');
                }
                if (!isLt1M) {
                    this.$message.error('上传头像图片大小不能超过 1MB!');
                }
                return isJPG && isLt1M;
            }
        }
    }
</script>