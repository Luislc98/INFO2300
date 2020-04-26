# Part 1: Plan, Create, and Populate a Database

## Database Schema

employees(id: INTEGER, employee_id: TEXT, first_name: TEXT, last_name: TEXT, position: INTEGER)
* id - PK, U, NOT, AI
* position - 1: staff, 2: manager

## SQL Queries

[Paste your correct SQL queries below.]

In markdown, format SQL queries like this:
```sql
SELECT * FROM movies;
```

1. get all fields for all employees

```sql
SELECT * FROM employees;
```

2. return two fields (e.g. first name, last name) for employees that are staff

```sql
SELECT first_name, last_name FROM employees WHERE position = 1;
```

3. return a natural key for employees who are managers

```sql
SELECT employee_id FROM employees WHERE position = 2;
```

4. return all fields for the employees who's first name starts with *a*

```sql
SELECT * FROM employees WHERE first_name LIKE 'a%';
```

5. return all fields for the employees who's last name ends with *n*

```sql
SELECT * FROM employees WHERE last_name LIKE '%n';
```

6. return all fields for the employees who have an *l* anywhere in their last name.

```sql
SELECT * FROM employees WHERE last_name LIKE '%l%';
```

7. return a natural key for employees who are staff and who's first name starts with *c*.

```sql
SELECT employee_id FROM employees WHERE position = 1 AND first_name LIKE 'c%';
```
