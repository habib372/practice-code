<?php
// admanager ==> new table

//Contents ==>
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


//dashboard_cards ==>
`status` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT 'active'


// discount_partners ==> new table

// facilities ==> new table

// facility_conditions ==> new table

// featured_service_providers ==> new table

//featured_service_provider_types ==> new table

// links ==> remane column
  `service_provider_type_id` bigint DEFAULT NULL to `featured_service_provider_type_id` bigint DEFAULT NULL

 
// medicines ==> new value add
(1, '-- [ Insert Medicine ] --', 'active', 2, NULL, '2020-12-28 09:18:15', '2020-12-28 09:18:15'),

// meeting_entries ==> new table

// memberships ==> new table

// membership_payments ==> new table












