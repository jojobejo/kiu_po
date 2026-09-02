ALTER TABLE `tbpo_jasa_vendor`
  ADD COLUMN IF NOT EXISTS `created_name` varchar(120) DEFAULT NULL AFTER `created_by`,
  ADD COLUMN IF NOT EXISTS `requested_by` varchar(50) DEFAULT NULL AFTER `updated_by`,
  ADD COLUMN IF NOT EXISTS `requested_name` varchar(120) DEFAULT NULL AFTER `requested_by`,
  ADD COLUMN IF NOT EXISTS `requested_departemen` varchar(100) DEFAULT NULL AFTER `requested_name`,
  ADD COLUMN IF NOT EXISTS `approved_by` varchar(50) DEFAULT NULL AFTER `requested_departemen`,
  ADD COLUMN IF NOT EXISTS `approved_name` varchar(120) DEFAULT NULL AFTER `approved_by`,
  ADD COLUMN IF NOT EXISTS `approved_at` datetime DEFAULT NULL AFTER `approved_name`;

ALTER TABLE `tbpo_jasa_request`
  ADD COLUMN IF NOT EXISTS `reviewed_by_purchasing` varchar(50) DEFAULT NULL AFTER `acc_at_kadep`,
  ADD COLUMN IF NOT EXISTS `reviewed_at_purchasing` datetime DEFAULT NULL AFTER `reviewed_by_purchasing`,
  ADD COLUMN IF NOT EXISTS `submitted_by_purchasing` varchar(50) DEFAULT NULL AFTER `reviewed_at_purchasing`,
  ADD COLUMN IF NOT EXISTS `submitted_at_purchasing` datetime DEFAULT NULL AFTER `submitted_by_purchasing`;
