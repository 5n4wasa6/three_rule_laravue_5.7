<template>
    <div>
        <!--<div class="sticky-header">-->
        <!--    <p>One Discussion: {{ $route.params.discuss_id }}</p>-->
        <!--</div>-->
        <div class="discussion-timeline">
            <div class="discussion-container">
                <div class="discussion-wrapper">
                    <div class="discussion">
                        <div class="discussion-top-part">
                            <div class="contributor-image">
                                <figure class="image">
                                    <progressive-img
                                        src="http://placehold.jp/48x48.png"
                                        placeholder="http://placehold.jp/48x48.png"
                                        :blur="30"
                                    />
                                </figure>
                            </div>
                            <div class="contributor-name">
                                {{ getDiscussionData.user.name }}
                            </div>
                        </div>
                        <div class="discussion-right-part">
                            <div class="post-contents">
                                <p class="content">
                                    {{ getDiscussionData.body }}
                                </p>
                            </div>
                            <!--<div class="post-image">-->
                                <!--<figure class="image">-->
                                <!--    <progressive-img-->
                                <!--        src="http://placehold.jp/250x150.png"-->
                                <!--        placeholder="http://placehold.jp/250x150.png"-->
                                <!--        :blur="30"-->
                                <!--    />-->
                                <!--</figure>-->
                                <!--<figure class="image">-->
                                <!--    <progressive-img-->
                                <!--        :src="'../images/' + getDiscussionData.image"-->
                                <!--        :blur="30"-->
                                <!--    />-->
                                <!--    {{ getDiscussionData.user.mypage[0].icon }}-->
                                <!--</figure>-->
                            <!--</div>-->
                        </div>
                    </div>
                </div>
            </div>
            <!--<div class="comment-options">-->
            <!--    <div class="comment-options-wrapper">-->
            <!--        <div class="start-discussion">-->
            <!--            <i class="fas fa-comment"></i>-->
            <!--            ディスカッションを開始する-->
            <!--        </div>-->
            <!--    </div>-->
            <!--</div>-->
            <div class="discussion-spaces">
                <div class="discussion-spaces-wrapper">
                    <div v-for="item in getDiscussionData.discussion_comment" :key="item.id" class="one-discussion">
                        <div class="one-discussion-wrapper">
                            <div class="one-discussion-left-part">
                                <div class="contributor-image contributor-image__commenter">
                                    <figure class="image">
                                        <progressive-img
                                            src="http://placehold.jp/48x48.png"
                                            placeholder="http://placehold.jp/48x48.png"
                                            :blur="30"
                                        />
                                        <!--{{ item.user.mypage[0].icon }}-->
                                    </figure>
                                </div>
                            </div>
                            <div class="one-discussion-right-part">
                                <div class="contributor-name contributor-name__commenter">
                                    <!--{{ item.user_id }}-->
                                    
                                    {{ item.user.name }}
                                </div>
                                <div class="post-contents">
                                    {{ item.comment }}
                                </div>
                            </div>
                            <div class="btn-wrapper" v-if="$route.params.user_id == item.user.id">
                                <button @click="editDiscussionCommentModalToggle(item.comment, item.id)" class="button is-small btn-edit">編集</button>
                                <button @click="deleteDiscussionCommentModalToggle(item.comment, item.id)" class="button is-small btn-del">削除</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-comment">
            <div class="d-flex">
                <input type="text" name="" v-model="comment" class="footer-input" placeholder="コメントを入力">
                <button class="footer-btn" @click="handleSendComment(comment, selectClubData[0].id, getDiscussionData.id)">送信</button>
            </div>
        </div>
        <edit-discussion-comment-modal
            v-if="editDiscussionCommentModalShow"
            @close="editDiscussionCommentModalToggle"
            :comment="comment"
            :club_id="$route.params.id"
            :discuss_id="getDiscussionData.id"
            :user_id="selectClubData[0].id"
            :comment_id="comment_id"
            :handleEditComment="handleEditComment">
        </edit-discussion-comment-modal>
        
        <delete-discussion-comment-modal
            v-if="deleteDiscussionCommentModalShow"
            @close="deleteDiscussionCommentModalToggle"
            :comment="comment"
            :discuss_id="getDiscussionData.id"
            :user_id="selectClubData[0].id"
            :comment_id="comment_id"
            :club_id="$route.params.id"
            :handleDeleteComment="handleDeleteComment">
        </delete-discussion-comment-modal>
    </div>
</template>

<script>
import StickyFooter from '../../components/club/StickyFooter';
import EditDiscussionCommentModal from '../../components/discussion/EditDiscussionCommentModal';
import DeleteDiscussionCommentModal from '../../components/discussion/DeleteDiscussionCommentModal';
import { mapGetters, mapActions } from 'vuex'
export default {
    name: 'OneDiscussion',
    components: {
        StickyFooter,
        EditDiscussionCommentModal,
        DeleteDiscussionCommentModal
    },
    data () {
        return {
            comment_id: '',
            comment: '',
            editDiscussionCommentModalShow: false,
            deleteDiscussionCommentModalShow: false
        }
    },
    computed: {
        ...mapGetters({
            clubData: 'discussion/discussionData',
            getDiscussionData: 'discussion/getDiscussionData',
            selectClubData: 'club/selectClubData'
        })
    },
    methods: {
        // ...mapActions({
        //     sendComment: 'discussion/sendComment',
        //     editSendComment: 'discussion/editSendComment',
        //     deleteSendComment: 'discussion/deleteSendComment',
        // }),
        sendComment(comment, club_id, discuss_id) {
          this.$store.dispatch('discussion/sendComment', {
              comment: comment, 
              club_id: this.$route.params.id,
              discuss_id: this.$route.params.discuss_id
          })
        },
        editSendComment(comment, club_id, discuss_id, discuss_comment_id) {
          this.$store.dispatch('discussion/editSendComment', {
              comment: comment, 
              club_id: this.$route.params.id,
              discuss_id: this.$route.params.discuss_id,
              discuss_comment_id: this.comment_id
          })
        },
        deleteSendComment(club_id, user_id, discuss_comment_id) {
          this.$store.dispatch('discussion/deleteSendComment', {
              club_id: this.$route.params.id,
              user_id: this.$route.params.user_id,
              discuss_comment_id: this.comment_id
          })
        },
        
        handleSendComment(comment) {
            this.sendComment({ comment: comment })
            this.comment = ''
        },
        editDiscussionCommentModalToggle(comment, id) {
            this.comment_id = id
            this.comment    = comment
            this.editDiscussionCommentModalShow = !this.editDiscussionCommentModalShow
        },
        
        deleteDiscussionCommentModalToggle(comment, id) {
            this.comment_id = id
            this.comment = comment
            this.deleteDiscussionCommentModalShow = !this.deleteDiscussionCommentModalShow
        },
        handleEditComment(comment, id) {
            this.editSendComment({ comment: comment })
            this.editDiscussionCommentModalShow = false
            this.comment = ''
            this.comment_id = ''
        },
        handleDeleteComment(id) {
            this.deleteSendComment({ id: id })
            this.deleteDiscussionCommentModalShow = false
            this.comment = ''
            this.comment_id = ''
        }
    }
};
</script>

<style scoped>
.discussion-timeline {
    margin: 8px 8px;
}
.discussion-container {
    padding: 8px;
    width: 100%;
    border-bottom: 1px solid rgba(0, 0, 0, 0.05);
}
.discussion-wrapper {
    padding: 8px;
    height: 100%;
    width: 100%;
}
.discussion {
    width: 100%;
    margin-top: 16px;
}
.discussion-top-part {
    display: flex;
    margin-right: 8px;
    margin-bottom: 4px;
}
    
.contributor-image {
    width: 48px;
    height: 48px;
    margin-right: 16px;
    z-index: -2;
}
.contributor-name {
    width: 100%;
}
.discussion-right-part {
    width: 100%;
    height: 100%;
}
.discussion-right-part .post-contents {
    overflow-wrap: break-word;
    margin-bottom: 8px;
}

.sticky-header {
    width: 100%;
    height: 50px;
    line-height: 16px;
    position: fixed;
    top: 0;
    border-bottom: 1px solid rgba(0, 0, 0, 0.05);
    background-color: #FCFCFC;
    z-index: 999;
}
.sticky-header p {
    position: absolute;
    text-align: center;
    top: 50%;
    left: 50%;
    -ms-transform: translate(-50%,-50%);
    -webkit-transform: translate(-50%,-50%);
    transform: translate(-50%,-50%);
    margin:0;
    padding:0;
    font-weight: bold;
    font-size: 16px;
}
.comment-options {
    padding: 8px;
    width: 100%;
    border-bottom: 1px solid rgba(0, 0, 0, 0.05);
}
.start-discussion {
    padding: 8px;
    height: 100%;
    width: 100%;
}
.discussion-spaces {
    padding: 8px;
    width: 100%;
}
.discussion-spaces-wrapper {
    padding: 8px;
    height: 100%;
    width: 100%;
}
/* .one-discussion {
    
} */
.one-discussion-wrapper {
    display: flex;
    width: 100%;
    margin-top: 16px;
}
/* .one-discussion-left-part {
} */
.one-discussion-right-part {
    width: 75%;
    height: 100%;
}
.one-discussion-right-part .contributor-name {
    width: 100%;
    height: 25px;
    margin-bottom: 4px;
}
.one-discussion-right-part .post-contents {
    overflow-wrap: break-word;
    margin-bottom: 8px;
}
.btn-wrapper {
    text-align: right;
}
.btn-edit {
    background-color: rgba(5, 40, 247, 95);
    border: none;
    border-radius: 3px;
    color: white;
    font-weight: bold;
    margin-bottom: 3px;
    /*width: 12%;*/
}
.btn-del {
    background-color: rgba(242, 27, 7, 100);
    border: none;
    border-radius: 3px;
    color: white;
    font-weight: bold;
    /*width: 12%;*/
}

.footer-comment {
    border-top: 1px solid #aaa;
    width: 100%;
    margin: 0 auto;
    padding: 8px;
    position: fixed;
    bottom: 0;
    right: 0;
    left: 0;
    z-index: 10;
    background: #fff;
}
.d-flex {
    display: flex;
    align-items: center;
}
.footer-input {
    border: none;
    width: 80%;
    margin: 0 auto;
    padding: 8px;
    outline: none;
}
.footer-btn {
    background: rgba(5, 40, 247, 95);
    border: none;
    color: white;
    font-weight: bold;
    margin-left: 2%;
    outline: none;
    padding: 8px;
    width: 18%;
}
.color {
    color: #fff;
}





@media screen and (max-width: 767px) {
    .sticky-header {
        height: 50px;
        line-height: 10px;
    }
}
</style>