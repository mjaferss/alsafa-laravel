# خطة تطوير الواجهة الأمامية

## المكتبات والأدوات
1. **Bootstrap 5**
   - تثبيت أحدث إصدار من Bootstrap
   - تكامل مع Laravel Mix/Vite
   - دعم RTL للغة العربية

2. **مكتبات JavaScript**
   - jQuery (مطلوب لـ Bootstrap)
   - Popper.js
   - SweetAlert2 للتنبيهات
   - DataTables للجداول
   - Select2 للقوائم المنسدلة المتقدمة

3. **الخطوط والأيقونات**
   - Font Awesome Pro
   - خط Cairo للعربية
   - خط Poppins للإنجليزية

## المكونات القابلة لإعادة الاستخدام (Components)

### 1. مكونات الإدخال
```php
// resources/views/components/forms/input.blade.php
<x-forms.input 
    type="text|email|password|number"
    name="field_name"
    label="حقل الإدخال"
    placeholder="أدخل البيانات"
    :required="true"
    :error="$errors->first('field_name')"
/>

// resources/views/components/forms/select.blade.php
<x-forms.select
    name="field_name"
    label="القائمة المنسدلة"
    :options="$options"
    :selected="$selected"
    :multiple="false"
    :searchable="true"
/>

// resources/views/components/forms/textarea.blade.php
<x-forms.textarea
    name="field_name"
    label="النص الطويل"
    :rows="4"
    :required="true"
/>
```

### 2. مكونات الأزرار
```php
// resources/views/components/buttons/primary.blade.php
<x-buttons.primary
    type="button|submit"
    :loading="false"
    icon="fa-save"
>
    حفظ البيانات
</x-buttons.primary>

// resources/views/components/buttons/secondary.blade.php
// resources/views/components/buttons/danger.blade.php
```

### 3. مكونات العرض
```php
// resources/views/components/cards/basic.blade.php
<x-cards.basic
    title="عنوان البطاقة"
    :collapsible="true"
    :loading="false"
>
    محتوى البطاقة
</x-cards.basic>

// resources/views/components/tables/datatable.blade.php
<x-tables.datatable
    :columns="$columns"
    :data="$data"
    :searchable="true"
    :sortable="true"
/>
```

### 4. مكونات التنبيهات
```php
// resources/views/components/alerts/success.blade.php
<x-alerts.success message="تم الحفظ بنجاح" />

// resources/views/components/alerts/error.blade.php
// resources/views/components/alerts/warning.blade.php
```

## هيكل الصفحات

### 1. القالب الرئيسي
```php
// resources/views/layouts/app.blade.php
- الشريط العلوي (Navbar)
- القائمة الجانبية (Sidebar)
- منطقة المحتوى الرئيسية
- الفوتر
```

### 2. تنسيق الشاشات المختلفة
- تصميم متجاوب (Responsive) لجميع الأحجام
- نقاط التوقف (Breakpoints):
  - XS: < 576px (الجوال)
  - SM: ≥ 576px (الجوال الأفقي)
  - MD: ≥ 768px (التابلت)
  - LG: ≥ 992px (الديسكتوب)
  - XL: ≥ 1200px (الشاشات الكبيرة)
  - XXL: ≥ 1400px (الشاشات الكبيرة جداً)

## الخطوات القادمة

1. **إعداد البيئة**
   - تثبيت المكتبات والأدوات
   - إعداد Laravel Mix/Vite
   - تكوين ملفات SASS/SCSS

2. **إنشاء المكونات**
   - تطوير وتوثيق كل مكون
   - إنشاء صفحة عرض المكونات (Components Showcase)
   - اختبار المكونات على مختلف أحجام الشاشات

3. **تطوير الصفحات**
   - تنفيذ نظام المصادقة
   - إنشاء لوحة التحكم
   - تطوير صفحات إدارة طلبات الصيانة
   - إنشاء النماذج والتقارير

4. **التحسينات**
   - تحسين الأداء
   - تحسين تجربة المستخدم
   - اختبار التوافقية مع المتصفحات
   - تحسين إمكانية الوصول (Accessibility)
