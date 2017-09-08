-- Issue #108 - [centreon-broker] Unable to insert two downtimes at the same
-- time.

ALTER TABLE `downtimes`
  DROP INDEX `entry_time`,
  ADD UNIQUE KEY `entry_time` (`entry_time`,`instance_id`,`internal_id`);

