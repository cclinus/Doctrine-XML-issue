CREATE TABLE product (
    product_id INTEGER PRIMARY KEY AUTOINCREMENT
);

INSERT INTO product VALUES (1);
INSERT INTO product VALUES (2);
INSERT INTO product VALUES (3);
INSERT INTO product VALUES (4);

CREATE TABLE product_description (
    product_id INTEGER,
    locale varchar(10) not null default '',
    description VARCHAR(255),
    primary key (product_id, locale)
);

INSERT INTO product_description (product_id, locale, description) VALUES (1, "en_US", "Pants");
INSERT INTO product_description (product_id, locale, description) VALUES (2, "en_US", "Shirt");
INSERT INTO product_description (product_id, locale, description) VALUES (3, "en_US", "Tie");
INSERT INTO product_description (product_id, locale, description) VALUES (4, "en_US", "Shoes");