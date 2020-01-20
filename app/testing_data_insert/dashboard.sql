INSERT INTO `dbapp`.`dashboards` (
    `title`,
    `desc`,
    `img`,
    `accessible_to`,
    `created_at`
  )
VALUES
  (
    'Hellow',
    'Some thing from db',
    'mdi-left-arrow',
    '2',
    '2020-01-19 19:30:43'
  );
  /* SQL Error (1364): Field 'link' doesn't have a default value */
INSERT INTO `dbapp`.`dashboards` (
    `title`,
    `desc`,
    `img`,
    `accessible_to`,
    `created_at`
  )
VALUES
  (
    'Hellow',
    'Some thing from db',
    'mdi-left-arrow',
    '2',
    '2020-01-19 19:30:43'
  );
  /* SQL Error (1364): Field 'link' doesn't have a default value */
INSERT INTO `dbapp`.`dashboards` (
    `title`,
    `desc`,
    `img`,
    `link`,
    `accessible_to`,
    `created_at`
  )
VALUES
  (
    'Hellow',
    'Some thing from db',
    'mdi-left-arrow',
    'localhost\\issues',
    '2',
    '2020-01-19 19:30:43'
  );
SELECT
  LAST_INSERT_ID();
SELECT
  `id`,
  `title`,
  `desc`,
  `img`,
  `size`,
  `seq`,
  `link`,
  `accessible_to`,
  `created_at`,
  `updated_at`
FROM `dbapp`.`dashboards`
WHERE
  `id` = 1;
INSERT INTO `dbapp`.`dashboards` (
    `title`,
    `desc`,
    `link`,
    `accessible_to`,
    `created_at`
  )
VALUES
  (
    'Salam',
    'habii',
    'localhost\\mdi-file',
    '2',
    '2020-01-19 19:49:18'
  );
SELECT
  LAST_INSERT_ID();
SELECT
  `id`,
  `title`,
  `desc`,
  `img`,
  `size`,
  `seq`,
  `link`,
  `accessible_to`,
  `created_at`,
  `updated_at`
FROM `dbapp`.`dashboards`
WHERE
  `id` = 2;
UPDATE `dbapp`.`dashboards`
SET
  `img` = 'mdi-file-document-edit'
WHERE
  `id` = 1;
SELECT
  `id`,
  `title`,
  `desc`,
  `img`,
  `size`,
  `seq`,
  `link`,
  `accessible_to`,
  `created_at`,
  `updated_at`
FROM `dbapp`.`dashboards`
WHERE
  `id` = 1;
UPDATE `dbapp`.`dashboards`
SET
  `img` = 'mdi-account-card-details'
WHERE
  `id` = 2;
SELECT
  `id`,
  `title`,
  `desc`,
  `img`,
  `size`,
  `seq`,
  `link`,
  `accessible_to`,
  `created_at`,
  `updated_at`
FROM `dbapp`.`dashboards`
WHERE
  `id` = 2;
UPDATE `dbapp`.`dashboards`
SET
  `title` = 'Assign Inspections'
WHERE
  `id` = 1;
SELECT
  `id`,
  `title`,
  `desc`,
  `img`,
  `size`,
  `seq`,
  `link`,
  `accessible_to`,
  `created_at`,
  `updated_at`
FROM `dbapp`.`dashboards`
WHERE
  `id` = 1;
UPDATE `dbapp`.`dashboards`
SET
  `title` = 'Account Managment'
WHERE
  `id` = 2;
SELECT
  `id`,
  `title`,
  `desc`,
  `img`,
  `size`,
  `seq`,
  `link`,
  `accessible_to`,
  `created_at`,
  `updated_at`
FROM `dbapp`.`dashboards`
WHERE
  `id` = 2;
INSERT INTO `dbapp`.`dashboards` (`title`)
VALUES
  ('Templates');
  /* SQL Error (1364): Field 'link' doesn't have a default value */
INSERT INTO `dbapp`.`dashboards` (`title`)
VALUES
  ('Templates');
  /* SQL Error (1364): Field 'link' doesn't have a default value */
INSERT INTO `dbapp`.`dashboards` (`title`, `img`)
VALUES
  ('Templates', 'mdi-clipboard-text-multiple');
  /* SQL Error (1364): Field 'link' doesn't have a default value */
INSERT INTO `dbapp`.`dashboards` (`title`, `img`)
VALUES
  ('Templates', 'mdi-clipboard-text-multiple');
  /* SQL Error (1364): Field 'link' doesn't have a default value */
INSERT INTO `dbapp`.`dashboards` (`title`, `img`)
VALUES
  ('Templates', 'mdi-clipboard-text-multiple');
  /* SQL Error (1364): Field 'link' doesn't have a default value */
INSERT INTO `dbapp`.`dashboards` (`title`, `img`, `link`)
VALUES
  (
    'Templates',
    'mdi-clipboard-text-multiple',
    'local'
  );
  /* SQL Error (1364): Field 'accessible_to' doesn't have a default value */
INSERT INTO `dbapp`.`dashboards` (`title`, `img`, `link`, `accessible_to`)
VALUES
  (
    'Templates',
    'mdi-clipboard-text-multiple',
    'local',
    '2'
  );
SELECT
  LAST_INSERT_ID();
SELECT
  `id`,
  `title`,
  `desc`,
  `img`,
  `size`,
  `seq`,
  `link`,
  `accessible_to`,
  `created_at`,
  `updated_at`
FROM `dbapp`.`dashboards`
WHERE
  `id` = 3;
UPDATE `dbapp`.`dashboards`
SET
  `created_at` = '2020-01-19 20:30:36'
WHERE
  `id` = 3;
SELECT
  `id`,
  `title`,
  `desc`,
  `img`,
  `size`,
  `seq`,
  `link`,
  `accessible_to`,
  `created_at`,
  `updated_at`
FROM `dbapp`.`dashboards`
WHERE
  `id` = 3;
INSERT INTO `dbapp`.`dashboards` (`title`, `img`)
VALUES
  ('Issue Tracker', 'mdi-bug');
  /* SQL Error (1364): Field 'link' doesn't have a default value */
INSERT INTO `dbapp`.`dashboards` (`title`, `img`)
VALUES
  ('Issue Tracker', 'mdi-bug');
  /* SQL Error (1364): Field 'link' doesn't have a default value */
INSERT INTO `dbapp`.`dashboards` (`title`, `img`)
VALUES
  ('Issue Tracker', 'mdi-bug');
  /* SQL Error (1364): Field 'link' doesn't have a default value */
INSERT INTO `dbapp`.`dashboards` (`title`, `img`)
VALUES
  ('Issue Tracker', 'mdi-bug');
  /* SQL Error (1364): Field 'link' doesn't have a default value */
INSERT INTO `dbapp`.`dashboards` (`title`, `img`)
VALUES
  ('Issue Tracker', 'mdi-bug');
  /* SQL Error (1364): Field 'link' doesn't have a default value */
INSERT INTO `dbapp`.`dashboards` (`title`, `img`, `link`, `accessible_to`)
VALUES
  ('Issue Tracker', 'mdi-bug', 'localhost', '2');
SELECT
  LAST_INSERT_ID();
SELECT
  `id`,
  `title`,
  `desc`,
  `img`,
  `size`,
  `seq`,
  `link`,
  `accessible_to`,
  `created_at`,
  `updated_at`
FROM `dbapp`.`dashboards`
WHERE
  `id` = 4;
INSERT INTO `dbapp`.`dashboards` (`img`)
VALUES
  ('mdi-timetable');
  /* SQL Error (1364): Field 'link' doesn't have a default value */
INSERT INTO `dbapp`.`dashboards` (`title`, `img`)
VALUES
  ('Pending Inspections', 'mdi-timetable');
  /* SQL Error (1364): Field 'link' doesn't have a default value */
INSERT INTO `dbapp`.`dashboards` (`title`, `img`)
VALUES
  ('Pending Inspections', 'mdi-timetable');
  /* SQL Error (1364): Field 'link' doesn't have a default value */
INSERT INTO `dbapp`.`dashboards` (
    `title`,
    `img`,
    `link`,
    `accessible_to`,
    `created_at`
  )
VALUES
  (
    'Pending Inspections',
    'mdi-timetable',
    'localhost',
    '2',
    '2020-01-19 20:31:54'
  );
SELECT
  LAST_INSERT_ID();
SELECT
  `id`,
  `title`,
  `desc`,
  `img`,
  `size`,
  `seq`,
  `link`,
  `accessible_to`,
  `created_at`,
  `updated_at`
FROM `dbapp`.`dashboards`
WHERE
  `id` = 5;
SELECT
  `id`,
  `title`,
  LEFT(`desc`, 256),
  `img`,
  `size`,
  `seq`,
  LEFT(`link`, 256),
  `accessible_to`,
  `created_at`,
  `updated_at`
FROM `dbapp`.`dashboards`
LIMIT
  1000;
SHOW CREATE TABLE `dbapp`.`dashboards`;
UPDATE `dbapp`.`dashboards`
SET
  `desc` = 'View your outstanding assognemnts here'
WHERE
  `id` = 5;
SELECT
  `id`,
  `title`,
  `desc`,
  `img`,
  `size`,
  `seq`,
  `link`,
  `accessible_to`,
  `created_at`,
  `updated_at`
FROM `dbapp`.`dashboards`
WHERE
  `id` = 5;
UPDATE `dbapp`.`dashboards`
SET
  `desc` = 'View all logged issues'
WHERE
  `id` = 4;
SELECT
  `id`,
  `title`,
  `desc`,
  `img`,
  `size`,
  `seq`,
  `link`,
  `accessible_to`,
  `created_at`,
  `updated_at`
FROM `dbapp`.`dashboards`
WHERE
  `id` = 4;
UPDATE `dbapp`.`dashboards`
SET
  `desc` = 'Update or create a new report template'
WHERE
  `id` = 3;
SELECT
  `id`,
  `title`,
  `desc`,
  `img`,
  `size`,
  `seq`,
  `link`,
  `accessible_to`,
  `created_at`,
  `updated_at`
FROM `dbapp`.`dashboards`
WHERE
  `id` = 3;
UPDATE `dbapp`.`dashboards`
SET
  `desc` = 'Shows all accounts for your orginization'
WHERE
  `id` = 2;
SELECT
  `id`,
  `title`,
  `desc`,
  `img`,
  `size`,
  `seq`,
  `link`,
  `accessible_to`,
  `created_at`,
  `updated_at`
FROM `dbapp`.`dashboards`
WHERE
  `id` = 2;