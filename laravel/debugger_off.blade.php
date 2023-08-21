AppServiceProvider.php

 public function boot()
    {
        \Debugbar::disable();
    }

INSERT INTO `dashboard_cards` (`id`, `card_name`, `status`) VALUES
(1,'Today\'s Appointments', 'active'),
(2,'Summary of Consultations', 'active'),
(3,'Summary of Chemotherapy Sessions', 'inactive'),
(4,'Types of Patients Consulted (disease type-wise)', 'active'),
(5,'Total Referrals Sent', 'active'),
(6,'Today\'s Chemotherapy Appointments', 'inactive'),
(7,'Top 10 Types of Cancer Patients Treated (Chemotherapy)', 'inactive'),
(8,'Total Consultation Served', 'active');