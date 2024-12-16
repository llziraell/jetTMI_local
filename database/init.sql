CREATE TABLE feedback (
                          id SERIAL PRIMARY KEY,
                          name VARCHAR(255) NOT NULL,
                          email VARCHAR(255) NOT NULL,
                          phone_number VARCHAR(255) NOT NULL,
                          message TEXT NOT NULL,
                          website VARCHAR(255) NOT NULL,
                          ip_address VARCHAR(255),
                          created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
);


-- Создание таблицы users
CREATE TABLE users (
                       id SERIAL PRIMARY KEY,
                       name VARCHAR(255),
                       email VARCHAR(255) UNIQUE NOT NULL,
                       email_verified_at TIMESTAMP,
                       password VARCHAR(255),
                       remember_token VARCHAR(100),
                       created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                       updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Создание других таблиц
CREATE TABLE password_reset_tokens (
                                       email VARCHAR(255) PRIMARY KEY,
                                       token VARCHAR(255) NOT NULL,
                                       created_at TIMESTAMP
);

CREATE TABLE sessions (
                          id VARCHAR(255) PRIMARY KEY,
                          user_id INTEGER REFERENCES users(id) ON DELETE CASCADE,
                          ip_address VARCHAR(45),
                          user_agent TEXT,
                          payload TEXT NOT NULL,
                          last_activity INTEGER NOT NULL
);

CREATE TABLE cache (
                       key VARCHAR(255) PRIMARY KEY,
                       value TEXT NOT NULL,
                       expiration INTEGER NOT NULL
);

CREATE TABLE cache_locks (
                             key VARCHAR(255) PRIMARY KEY,
                             owner VARCHAR(255) NOT NULL,
                             expiration INTEGER NOT NULL
);

insert into public.users (
                          id, name, email, email_verified_at, password, remember_token, created_at, updated_at)
                        values (1, null, 'kakawka904@gmail.com', null, null, null, null, null);
insert into public.users (
                          id, name, email, email_verified_at, password, remember_token, created_at, updated_at)
                        values (2, null, 'alex.sokolovva@gmail.com', null, null, null, null, null);
