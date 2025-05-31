# Al-Safa Apartment Management System API Documentation

## Base URL
```
http://localhost:8000/api
```

## Authentication
Most API routes require authentication using Laravel Sanctum. Include the token in the Authorization header:
```
Authorization: Bearer {your-token}
```

### Authentication Endpoints

#### Login
```http
POST /api/login
```
Body:
```json
{
    "email": "user@example.com",
    "password": "password123"
}
```
Response:
```json
{
    "token": "your-access-token",
    "user": {
        "id": 1,
        "name": "User Name",
        "email": "user@example.com",
        "role": "admin"
    }
}
```

#### Register
```http
POST /api/register
```
Body:
```json
{
    "name": "User Name",
    "email": "user@example.com",
    "password": "password123",
    "password_confirmation": "password123",
    "branch_id": 1
}
```

#### Logout
```http
POST /api/logout
```

#### Forgot Password
```http
POST /api/forgot-password
```
Body:
```json
{
    "email": "user@example.com"
}
```

#### Reset Password
```http
POST /api/reset-password
```
Body:
```json
{
    "token": "reset-token",
    "email": "user@example.com",
    "password": "new-password",
    "password_confirmation": "new-password"
}
```

#### Change Password
```http
POST /api/change-password
```
Body:
```json
{
    "current_password": "current-password",
    "password": "new-password",
    "password_confirmation": "new-password"
}
```

### User Profile

#### Get Profile
```http
GET /api/profile
```

#### Update Profile
```http
PUT /api/profile
```
Body:
```json
{
    "name": "Updated Name",
    "email": "updated@example.com",
    "phone": "+966123456789"
}
```

### Users Management

#### Get All Users
```http
GET /api/users
```
Response:
```json
{
    "data": [
        {
            "id": 1,
            "name": "User Name",
            "email": "user@example.com",
            "role": "admin",
            "branch": {
                "id": 1,
                "name": "Main Branch"
            },
            "is_active": true,
            "last_login": "2025-05-25 22:00:00"
        }
    ]
}
```

#### Get Single User
```http
GET /api/users/{id}
```

#### Create User
```http
POST /api/users
```
Body:
```json
{
    "name": "New User",
    "email": "newuser@example.com",
    "password": "password123",
    "password_confirmation": "password123",
    "role": "supervisor",
    "branch_id": 1
}
```

#### Update User
```http
PUT /api/users/{id}
```
Body: Same as Create User

#### Delete User
```http
DELETE /api/users/{id}
```

#### Activate User
```http
POST /api/users/{id}/activate
```

#### Deactivate User
```http
POST /api/users/{id}/deactivate
```

#### Change User Role
```http
POST /api/users/{id}/change-role
```
Body:
```json
{
    "role": "manager"
}
```

## API Endpoints

### Maintenance Requests (طلبات الصيانة)

#### Get All Maintenance Requests
```http
GET /api/maintenance-requests
```

**Query Parameters:**
- `page`: رقم الصفحة (افتراضي: 1)
- `per_page`: عدد العناصر في الصفحة (افتراضي: 15)
- `search`: البحث في العنوان والوصف
- `status`: تصفية حسب الحالة (pending, supervisor_approved, supervisor_rejected, manager_approved, manager_rejected)
- `branch_id`: تصفية حسب الفرع
- `tower_id`: تصفية حسب البرج
- `main_section_id`: تصفية حسب القسم الرئيسي
- `user_id`: تصفية حسب المستخدم
- `supervisor_id`: تصفية حسب المشرف
- `manager_id`: تصفية حسب المدير
- `supervisor_approval`: تصفية حسب موافقة المشرف (true/false)
- `manager_approval`: تصفية حسب موافقة المدير (true/false)
- `with_relations`: تحميل العلاقات (true/false)

**Response:**
```json
{
    "data": [
        {
            "id": 1,
            "branch": {
                "id": 1,
                "name": "الفرع الرئيسي"
            },
            "tower": {
                "id": 1,
                "name": "برج A"
            },
            "main_section": {
                "id": 1,
                "name": "قسم الصيانة"
            },
            "user": {
                "id": 1,
                "name": "مقدم الطلب"
            },
            "supervisor": {
                "id": 2,
                "name": "المشرف"
            },
            "manager": {
                "id": 3,
                "name": "المدير"
            },
            "status": "pending",
            "notes": "ملاحظات الطلب",
            "subtotal": 1000,
            "tax": 150,
            "total": 1150,
            "supervisor_approval": null,
            "supervisor_notes": null,
            "supervisor_action_at": null,
            "manager_approval": null,
            "manager_notes": null,
            "manager_action_at": null,
            "items": [
                {
                    "id": 1,
                    "maintenance_description": {
                        "id": 1,
                        "name": "صيانة التكييف",
                        "cost": 500
                    },
                    "quantity": 2,
                    "note": "ملاحظات العنصر"
                }
            ],
            "created_at": "2025-05-26T14:24:25.000000Z",
            "updated_at": "2025-05-26T14:24:25.000000Z"
        }
    ],
    "meta": {
        "current_page": 1,
        "from": 1,
        "last_page": 1,
        "per_page": 15,
        "to": 1,
        "total": 1
    }
}
```

#### Get Single Maintenance Request
```http
GET /api/maintenance-requests/{id}
```

**Response:** نفس تنسيق عنصر واحد من القائمة السابقة

#### Create Maintenance Request
```http
POST /api/maintenance-requests
```

**Body:**
```json
{
    "branch_id": 1,
    "tower_id": 1,
    "main_section_id": 1,
    "notes": "ملاحظات الطلب",
    "items": [
        {
            "maintenance_description_id": 1,
            "quantity": 2,
            "note": "ملاحظات العنصر"
        }
    ]
}
```

#### Update Maintenance Request
```http
PUT /api/maintenance-requests/{id}
```

**Body:**
```json
{
    "branch_id": 1,
    "tower_id": 1,
    "main_section_id": 1,
    "notes": "ملاحظات محدثة",
    "supervisor_id": 2,
    "supervisor_approval": true,
    "supervisor_notes": "موافقة المشرف",
    "supervisor_action_at": "2025-05-26T14:24:25.000000Z",
    "manager_id": 3,
    "manager_approval": true,
    "manager_notes": "موافقة المدير",
    "manager_action_at": "2025-05-26T14:24:25.000000Z",
    "status": "manager_approved",
    "items": [
        {
            "maintenance_description_id": 1,
            "quantity": 3,
            "note": "ملاحظات محدثة"
        }
    ]
}
```

#### Delete Maintenance Request
```http
DELETE /api/maintenance-requests/{id}
```

### Branches (الفروع)

#### Get All Branches
```http
GET /api/branches
```
Response:
```json
{
    "data": [
        {
            "id": 1,
            "name": "الفرع الرئيسي",
            "name_ar": "الفرع الرئيسي",
            "name_en": "Main Branch",
            "address": "شارع الملك فهد",
            "address_ar": "شارع الملك فهد",
            "address_en": "King Fahd Road",
            "phone": "+966123456789",
            "is_active": true
        }
    ]
}
```

#### Get Single Branch
```http
GET /api/branches/{id}
```

#### Create Branch
```http
POST /api/branches
```
Body:
```json
{
    "name_ar": "الفرع الرئيسي",
    "name_en": "Main Branch",
    "address_ar": "شارع الملك فهد",
    "address_en": "King Fahd Road",
    "phone": "+966123456789",
    "is_active": true
}
```

#### Update Branch
```http
PUT /api/branches/{id}
```
Body: Same as Create

#### Delete Branch
```http
DELETE /api/branches/{id}
```

### Towers (الأبراج)

#### Get All Towers
```http
GET /api/towers
```
Response:
```json
{
    "data": [
        {
            "id": 1,
            "name": "برج السلام",
            "name_ar": "برج السلام",
            "name_en": "Al Salam Tower",
            "branch_id": 1,
            "cost": 1000000.00,
            "is_active": true,
            "branch": {
                "id": 1,
                "name": "الفرع الرئيسي"
            }
        }
    ]
}
```

#### Get Single Tower
```http
GET /api/towers/{id}
```

#### Create Tower
```http
POST /api/towers
```
Body:
```json
{
    "name_ar": "برج السلام",
    "name_en": "Al Salam Tower",
    "branch_id": 1,
    "cost": 1000000.00,
    "is_active": true
}
```

#### Update Tower
```http
PUT /api/towers/{id}
```
Body: Same as Create

#### Delete Tower
```http
DELETE /api/towers/{id}
```

### Main Sections (الأقسام الرئيسية)

#### Get All Sections
```http
GET /api/main-sections
```
Response:
```json
{
    "data": [
        {
            "id": 1,
            "name": "قسم الصيانة",
            "name_ar": "قسم الصيانة",
            "name_en": "Maintenance Section",
            "cost": 5000.00,
            "is_active": true
        }
    ]
}
```

#### Get Single Section
```http
GET /api/main-sections/{id}
```

#### Create Section
```http
POST /api/main-sections
```
Body:
```json
{
    "name_ar": "قسم الصيانة",
    "name_en": "Maintenance Section",
    "cost": 5000.00,
    "is_active": true
}
```

#### Update Section
```http
PUT /api/main-sections/{id}
```
Body: Same as Create

#### Delete Section
```http
DELETE /api/main-sections/{id}
```

### Maintenance Descriptions (أوصاف الصيانة)

#### Get All Descriptions
```http
GET /api/maintenance-descriptions
```
Response:
```json
{
    "data": [
        {
            "id": 1,
            "description": "صيانة مكيف سبليت",
            "description_ar": "صيانة مكيف سبليت",
            "description_en": "Split AC Maintenance",
            "is_active": true,
            "created_at": "2025-05-25 22:00:00"
        }
    ]
}
```

#### Get Single Description
```http
GET /api/maintenance-descriptions/{id}
```

#### Create Description
```http
POST /api/maintenance-descriptions
```
Body:
```json
{
    "description_ar": "صيانة مكيف سبليت",
    "description_en": "Split AC Maintenance",
    "is_active": true
}
```

### Maintenance Requests (طلبات الصيانة)

#### Get All Requests
```http
GET /api/maintenance-requests
```
Response:
```json
{
    "data": [
        {
            "id": 1,
            "user": {
                "id": 1,
                "name": "أحمد"
            },
            "branch": {
                "id": 1,
                "name": "الفرع الرئيسي"
            },
            "tower": {
                "id": 1,
                "name": "برج السلام"
            },
            "main_section": {
                "id": 1,
                "name": "قسم الصيانة"
            },
            "notes": "صيانة مكيفات الدور الأول",
            "subtotal": 1000.00,
            "tax": 150.00,
            "total": 1150.00,
            "status": "pending",
            "items": [
                {
                    "id": 1,
                    "description": {
                        "id": 1,
                        "description": "صيانة مكيف سبليت"
                    },
                    "quantity": 2,
                    "unit_price": 500.00,
                    "has_tax": true,
                    "tax_amount": 150.00,
                    "subtotal": 1000.00,
                    "total": 1150.00
                }
            ]
        }
    ]
}
```

#### Get Single Request
```http
GET /api/maintenance-requests/{id}
```

#### Create Request
```http
POST /api/maintenance-requests
```
Body:
```json
{
    "branch_id": 1,
    "tower_id": 1,
    "main_section_id": 1,
    "notes": "صيانة مكيفات الدور الأول",
    "items": [
        {
            "maintenance_description_id": 1,
            "quantity": 2,
            "unit_price": 500.00,
            "has_tax": true
        }
    ]
}
```

#### Update Request
```http
PUT /api/maintenance-requests/{id}
```
Body: Same as Create

#### Delete Request
```http
DELETE /api/maintenance-requests/{id}
```

#### Supervisor Approval
```http
POST /api/maintenance-requests/{id}/supervisor-approval
```
Body:
```json
{
    "approval": true,
    "notes": "تمت الموافقة على الطلب"
}
```

#### Manager Approval
```http
POST /api/maintenance-requests/{id}/manager-approval
```
Body:
```json
{
    "approval": true,
    "notes": "تمت الموافقة النهائية"
}
```

## Response Codes
- `200` - OK
- `201` - Created
- `400` - Bad Request
- `401` - Unauthorized
- `403` - Forbidden
- `404` - Not Found
- `422` - Validation Error
- `500` - Server Error

## Error Response Format
```json
{
    "message": "The given data was invalid.",
    "errors": {
        "field": [
            "The field is required."
        ]
    }
}
```

## Pagination
All list endpoints support pagination using the following query parameters:
```
/api/endpoint?page=1&per_page=15
```

## Filtering
Most endpoints support filtering using query parameters:
```
/api/maintenance-requests?status=pending
/api/towers?branch_id=1&is_active=true
```

## Sorting
Most endpoints support sorting using the sort parameter:
```
/api/maintenance-requests?sort=-created_at
```
Use `-` for descending order and `+` or no prefix for ascending order.

## Language
Use the `Accept-Language` header to specify the response language:
```
Accept-Language: ar
Accept-Language: en
```
This will affect the localized fields like names and descriptions.
