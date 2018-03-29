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
                        :data = "loadData"
                        :headers="header"
                        :action="host+'/api/content/uploadImg'"
                        :show-file-list="false"
                        :multiple="false"
                        :on-success="handleAvatarSuccess"
                        :before-upload="beforeAvatarUpload">
                    <img v-if="post.img" :src="post.img" class="avatar">
                    <i v-else class="el-icon-plus avatar-uploader-icon"></i>
                </el-upload>
            </el-form-item>
            {{post.img}}
            <el-form-item label="标签">
                <el-input v-model="post.abs"></el-input>
            </el-form-item>

            <el-form-item label="正文">
                <vue-editor v-model="post.content" useCustomImageHandler
                            @imageAdded="handleImageAdded" ></vue-editor>
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
                loadData:{
                    post_id:0
                },
                post:{
                    id:0,
                    title:'',
                    content:'',
                    abs:'' ,
                    img:'',
                    type:'share'
                },

            }
        },
        components: {
            VueEditor
        },
        mounted(){
            this.init()
        },
        methods:{
            init:function(){
                let t = this
                this.$ajax.post(window.host+'/api/content/initPost',t.post).then((res)=>{
                    switch (res.data.err_code){
                        case 0:
                            t.post=res.data.data
                            t.loadData.post_id = res.data.data.id
                            break;
                        case -1:
                            t.$message.error(res.data.msg)
                            t.suc()
                            break;
                        default:
                            break;
                    }
                },(res)=>{})
            },
            onSubmit:function(){
//                console.log(this.post)
//                return false
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
                this.$ajax.post(window.host+'/api/content/edit',t.post).then((res)=>{
                    if(res.data.err_code!=0){
                        this.$message.error(res.data.msg)
                    }else {
                        this.$message.success('添加成功！')
                        setTimeout(t.suc,1000)
                    }
                },(res)=>{})
            },
            suc:function () {
                this.$router.push('/content')
            },
            handleAvatarSuccess:function (res,file) {
                this.imageUrl = URL.createObjectURL(file.raw);
//                this.post.img = res.data.local
                this.$set(this.post,'img',res.data.local)
            },
            beforeAvatarUpload(file) {
//                console.log(file)
                const isJPG = file.type === 'image/jpeg'||file.type === 'image/png';
                const isLt1M = file.size / 1024 / 1024 < 1;
                if (!isJPG) {
                    this.$message.error('上传图片只能是 JPG 或 PNG 格式!');
                }
                if (!isLt1M) {
                    this.$message.error('上传图片大小不能超过 1MB!');
                }
                return isJPG && isLt1M;
            },
            handleImageAdded: function(file, Editor, cursorLocation, resetUploader) {
                // An example of using FormData
                // NOTE: Your key could be different such as:
                // formData.append('file', file)
                var formData = new FormData();
                let t = this
                formData.append('file', file)
                formData.append('post_id',t.post.id)
                this.$ajax({
                    url: window.host+'/api/content/uploadImg',
                    method: 'POST',
                    data: formData
                })
                    .then((result) => {
                        let url = result.data.data.local // Get url from response
                        Editor.insertEmbed(cursorLocation, 'image', url);
                        t.post.pics.push(res.data.data.id)
                        resetUploader();
                    })
                    .catch((err) => {
                        console.log(err);
                    })
            }
        }
    }
</script>