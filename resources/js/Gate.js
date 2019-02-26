export default class Gate{
    constructor(user) 
    {
        this.user = user;
    }

    isAdminOrAuthor()
    {
        if(this.user.type === 'admin' || this.user.type === 'author')
        {
            return true;
        }
    }

    isAdmin()
    {
        return this.user.type === 'admin';
    }

    isUser()
    {
        return this.user.type === 'user';
    }

    isAuthor()
    {
        return this.user.type === 'author';
    }
}