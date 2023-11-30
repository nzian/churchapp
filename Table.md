# tables

1 Notifications
created_by and updated_by is always reference an user. May be pastor may be system admin. Other table relation column always named as table name singular form _ id. Notifications table hold all notifications created by Pastor of a church and when Pastor send notification then those will be stored in UserNotifications table to track read and unread

- id
- title
- description
- published
- published_at
- created_by
- updated_by
- church_id
- pastor_id
- created_at
- updated_at
- deleted_at

2 Users

All church users. they only can view notifications and events.

- id
- name
- device_token
- status
- email
- phone
- church_id
- created_at
- updated_at
- deleted_at

3 Pastors

Pastors are admin of a church. So Pastor can create, update, delete and publish notifications. update church information.

- id
- name
- email
- status
- church_id
- created_at
- updated_at
- deleted_at

4 UserNotifications
When pastor publish any notification then it will filled with user_id and notification_id read and unread status

- id
- user_id
- notification_id
- read
- church_id
- created_at
- updated_at
- deleted_at

5 Churches

- id
- name
- firebaseId
- address
- location
- social_media_links
- created_by
- updated_by
- created_at
- updated_at
- deleted_at

## Application functions

1 Pastor: Church admin.

- create update delete notifications
- publish notifications
- add or update some app configurations
- Update church information

2 User: church end user.

- view and read notifications
- browse app
