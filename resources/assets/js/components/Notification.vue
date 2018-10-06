<template>  
<li class="navbar-item navbar-toggler-right" style="display:inline;">                            
    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"> <span class="glyphicon glyphicon-globe"></span>
            <i class="fas fa-bell"></i> <span class="badge">{{ notifications.length }}</span> <span class="caret"></span>
        </a>

   <ul class="dropdown-menu dropdown-menu-right" role="menu" >
        <li class="nav-item dropdown"  v-for="notification in notifications" >
            <a href="#" v-on:click="MarkAsRead(notification)" style="font-size: 12px;">
                
                <small style="color:black;">{{ notification.data.post.post_title.substring(0,10)+'...' }}</small>
                有新留言!
            </a>
        </li>
        <li v-if="notifications.length == 0">
            There is no new notifications
        </li>
    </ul>
   
</li>

</template>

<script>	
    export default {
        props: ['notifications'],
        methods: {
            MarkAsRead: function(notification) {
                
                var data = {
                    id: notification.id
                };
                axios.post('/notification/read', data).then(response => {
                    window.location.href = "/post/info/" + notification.data.post_code;
                });
            }
        }

    }
</script>
