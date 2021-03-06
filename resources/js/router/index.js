import Vue       from 'vue';
import VueRouter from 'vue-router';
/*
 * Top, Corporate
 */
import Top      from '../pages/top/TheTop';
import Login    from '../pages/Login';
import Register from '../pages/Register';
import About    from '../pages/top/About';
import News     from '../pages/top/News';
import Recruit  from '../pages/top/Recruit';
import Service  from '../pages/top/Service';
import Contact  from '../pages/top/Contact';
/*
 * Service
 */
import SelectClub      from '../pages/club/SelectClub';
import CreateClub      from '../pages/club/CreateClub';
import Club            from '../pages/club/Club';
import ClubMember      from '../pages/club/ClubMember';
import Invite          from '../pages/club/Invite';
import MyPage          from '../pages/club/MyPage';
import MyJournalCreate from '../pages/club/MyJournalCreate';
import OneMyJournal    from '../pages/club/OneMyJournal';
import Discussion      from '../pages/club/Discussion';
import OneDiscussion   from '../pages/club/OneDiscussion';
import Menu            from '../pages/club/Menu';
import MenuCreate      from '../pages/club/MenuCreate';
import OneMenu         from '../pages/club/OneMenu';
import Calendar        from '../pages/club/Calendar';
 
Vue.use(VueRouter);
 
const routes = [
    {
        path:'/',
        component: Top
    },
    {
        path:'/login',
        component: Login,

    },
    {
        path:'/register',
        component: Register,
    },
    {
        path:'/about',
        component: About,

    },
    {
        path:'/news',
        component: News,
    },
    {
        path:'/recruit',
        component: Recruit,
    },
    {
        path:'/service',
        component: Service,
    },
    {
        path:'/contact',
        component: Contact,
    },
    {
        path:'/selectclub',
        name: 'SelectClub',
        component: SelectClub
    },
    {
        path:'/club/create',
        name: 'CreateClub',
        component: CreateClub
    },
    {
        path:'/club/:id/invite',
        name: 'Invite',
        component: Invite,
        props: route => ({
            id: Number(route.params.id)
        })
    },
    {
        path:'/club/:id/user/:user_id',
        name: 'Club',
        component: Club,
        props: route => ({
            id:      Number(route.params.id),
            user_id: Number(route.params.user_id)
        })
    },
    {
        path:'/club/:id/member',
        name: 'ClubMember',
        component: ClubMember,
        props: route => ({
            id: Number(route.params.id)
        })
    },
    {
        path:'/club/:id/mypage/:user_id',
        name: 'Mypage',
        component: MyPage,
        props: route => ({
            id:      Number(route.params.id),
            user_id: Number(route.params.user_id)
        })
    },
    {
        path:'/club/:id/mypage/:user_id/myjournal',
        name: 'MyJournalCreate',
        component: MyJournalCreate,
        props: route => ({
            id:      Number(route.params.id),
            user_id: Number(route.params.user_id)
        })
    },
    {
        path:'/club/:id/mypage/:user_id/onemyjournal/:myjournal_id',
        name: 'OneMyJournal',
        component: OneMyJournal,
        props: route => ({
            id:           Number(route.params.id),
            user_id:      Number(route.params.user_id),
            myjournal_id: Number(route.params.myjournal_id),
        })
    },
    {
        path:'/club/:id/user/:user_id/discussion',
        name: 'Discussion',
        component: Discussion,
        props: route => ({
            id:      Number(route.params.id),
            user_id: Number(route.params.user_id)
        })
    },
    {
        path:'/club/:id/user/:user_id/onediscussion/:discuss_id',
        name: 'OneDiscussion',
        component: OneDiscussion,
        props: route => ({
            id:         Number(route.params.id),
            user_id:    Number(route.params.user_id),
            discuss_id: Number(route.params.id)
        })
    },
    {
        path:'/club/:id/user/:user_id/menu',
        name: 'Menu',
        component: Menu,
        props: route => ({
            id:      Number(route.params.id),
            user_id: Number(route.params.user_id)
        })
    },
    {
        path:'/club/:id/user/:user_id/menu/create',
        name: 'MenuCreate',
        component: MenuCreate,
        props: route => ({
            id:      Number(route.params.id),
            user_id: Number(route.params.user_id)
        })
    },
    {
        path:'/club/:id/user/:user_id/onemenu/:menu_id',
        name: 'OneMenu',
        component: OneMenu,
        props: route => ({
            id:      Number(route.params.id),
            user_id: Number(route.params.user_id),
            menu_id: Number(route.params.id)
        })
    },
    {
        path:'/club/:id/user/:user_id/calendar',
        name: 'Calendar',
        component: Calendar,
        props: route => ({
            id:      Number(route.params.id),
            user_id: Number(route.params.user_id)
        })
    }
];
 
const router = new VueRouter({
    mode: 'history',
    routes,
    // Established tactic
    scrollBehavior (to, from, savedPosition) {
        if (savedPosition) {
          return savedPosition
        } else {
          return { x: 0, y: 0 }
        }
      }
});
 
export default router;