<?php
// admanager ==> new table

// Appointments ==> add new value

// Appointment_bills ==> add new value

// Carers ==> add new value

// chemotherapies ==> add new value

// chemotherapy_bills ==> add new value

//Contents ==> add column and data
`image_en` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
`image_bn` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
`meta_title_en` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
`meta_title_bn` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
`meta_tag_en` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
`meta_tag_bn` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
`meta_description_en` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
`meta_description_bn` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
`author_name_en` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
`author_name_bn` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
`author_designation_en` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT  NULL,
`author_designation_bn` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT  NULL,
`publication_date` date DEFAULT NULL,
UPDATE contents SET publication_date = DATE(updated_at);

//dashboard_cards ==> add column
`status` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT 'active'

// discount_partners ==> new table

##  disease_types ==> new value
##  doctors ==> new value

// facilities ==> new table

// facility_conditions ==> new table

// featured_service_providers ==> new table

//featured_service_provider_types ==> new table

// links ==> rename column
  `service_provider_type_id` bigint DEFAULT NULL to `featured_service_provider_type_id` bigint DEFAULT NULL


// medicines ==> new value add
(1, '-- [ Insert Medicine ] --', 'active', 2, NULL, '2020-12-28 09:18:15', '2020-12-28 09:18:15'),

// meeting_entries ==> new table

// memberships ==> new table

// membership_payments ==> new table

// patients ==> new column and value add
`patient_type` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
`disease_type_id` bigint(20) UNSIGNED DEFAULT NULL,
`disease_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL, # -modify

// patient_visits ==> new column and value add
`disease_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
`bp_high` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
`bp_low` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
`pregnency_status` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
`smoker` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
`drinker` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
`vaccination_status` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,

// patient_visit_examinations ==> modify column and add data
`examination_id` int(11) DEFAULT NULL,

// patient_visit_medicines ==> modify column and add data
`medicine_id` int(11) NOT NULL DEFAULT 1,

// patient_visit_referrals ==> new table

//service_provider_types ==> add new column.
`logo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
`created_by` bigint(20) UNSIGNED DEFAULT NULL,
`updated_by` bigint(20) UNSIGNED DEFAULT NULL,

// sliders ==> new value add

// specialists ==> new table

// sponsorships ==> new table
// sponsorship_attachments ==> new table
// sponsorship_contents ==> new table
// sponsorship_verifies ==> new table

// super_consultant_comments ==> new table

// users ==> add new column and data
`service_provider_type_id` bigint(20) UNSIGNED DEFAULT NULL,
`created_by` int(10) DEFAULT NULL,
`updated_by` int(10) DEFAULT NULL,

// user_meetings ==> add new table




// ERROR solved

#1. MySQL: MySQL Server has gone away when importing large sql file
my.ini file:

search: [mysqld]
wait_timeout = 600
max_allowed_packet = 64M


#2. PHP: Can't import database through phpmyadmin file size too large
php.ini file:

upload_max_filesize = 100M
post_max_size = 100M
max_execution_time = 259200
max_input_time = 259200
memory_limit = 1000M

