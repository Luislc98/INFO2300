# SQL Join Problems

## Activity 1. Students and Jobs

- The **students** table is a list of students enrolled at School 2300. Information includes their name and year.
- The **majors** table is a list of majors at School 2300.
- The **jobs** table is a list of positions at 2300 Company where they are willing to let students shadow. They have a recommended major for each position.

### a) List all students and their respective majors (include undeclared, meaning NULL, majors).

*This information is stored in several different tables so we need to JOIN the tables to put the information together.*

1. What tables do you need? Put an x between the `[x]`.

    - [x] students
    - [x] majors
    - [ ] jobs

    *All of these tables hold some valuable information, but for this query, we specifically need the tables that have student names and on majors.*

2. Which table should be your *left* table? Which table should be your *right* table?

    - Left Table: students
    - Right Table: majors

3. What type of join do you need? Put an x between the `[x]`.

    *Think about if you care if values from your left, right, or both tables are NULL.*

    - [ ] INNER JOIN
    - [X] LEFT OUTER JOIN

4. What fields do you need?

    *Think about the primary and foreign keys we can use to JOIN the tables.*
    *Think about the field we want in our result.*

    students.first_name, students.last_name, majors.major, students.major_id, majors.id;

5. Write the SQL query and execute the query to test it in DB Browser for SQLite.

    ```sql
    SELECT students.first_name, students.last_name, majors.major FROM students LEFT OUTER JOIN majors ON students.major_id=majors.id;
    ```

    You should get the following result:
    |     | first_name | last_name | major               |
    | --- | ---------- | --------- | ------------------- |
    | 1   | John       | Piper     | *NULL*              |
    | 2   | Kailey     | Madison   | Information Science |
    | 3   | Savannah   | Kelly     | Computer Science    |
    | .   | ...        | ...       | ...                 |
    ...
    with 16 rows total.


### b) List the students and all of their job matches, if any.

1. What tables do you need? Put an x between the `[x]`.

    - [x] students
    - [ ] majors
    - [x] jobs

2. Which table should be your *left* table? Which table should be your *right* table?

    - Left Table: students
    - Right Table: jobs

3. What type of join do you need? Put an x between the `[x]`.

    *Think about if you care if values from your left, right, or both tables are NULL.*

    - [ ] INNER JOIN
    - [x] LEFT OUTER JOIN

4. What fields do you need?

    students.first_name, students.last_name, jobs.position, students.major_id, jobs.major_id

5. Write the SQL query and execute the query to test it in DB Browser for SQLite.

    ```sql
    SELECT students.first_name, students.last_name, jobs.position FROM students LEFT OUTER JOIN jobs ON students.major_id=jobs.major_id;
    ```

    You should get the following result:
    |     | first_name | last_name | position          |
    | --- | ---------- | --------- | ----------------- |
    | 1   | John       | Piper     | *NULL*            |
    | 2   | Kailey     | Madison   | Data Scientist    |
    | 3   | Kailey     | Madison   | User Experience   |
    | 4   | Savannah   | Kelly     | Software Engineer |
    | 5   | Savannah   | Kelly     | Test Engineer     |
    | .   | ...        | ...       | ...               |
    ...
    with 24 rows total.


### c) List all the position that are matched with majors.

1. What tables do you need? Put an x between the `[x]`.

    - [ ] students
    - [x] majors
    - [x] jobs

2. Which table should be your *left* table? Which table should be your *right* table?

    - Left Table: jobs
    - Right Table: majors

3. What type of join do you need? Put an x between the `[x]`.

    *Think about if you care if values from your left, right, or both tables are NULL.*

    - [x] INNER JOIN
    - [ ] LEFT OUTER JOIN

4. What fields do you need?

    jobs.position, majors.major, majors.id, jobs.major_id

5. Write the SQL query and execute the query to test it in DB Browser for SQLite.

    ```sql
    SELECT jobs.position, majors.major FROM jobs INNER JOIN majors ON majors.id=jobs.major_id;
    -- Technically also works with this:
    SELECT jobs.position, majors.major FROM jobs LEFT OUTER JOIN majors ON majors.id=jobs.major_id WHERE jobs.major_id IS NOT NULL;
    ```

    You should get the following result:
    |     | position          | major               |
    | --- | ----------------- | ------------------- |
    | 1   | Software Engineer | Computer Science    |
    | 2   | User Experience   | Information Science |
    | 3   | Data Scientist    | Information Science |
    | .   | ...               | ...                 |
    ...
    with 7 rows total.


## Activity 2. Students and Dorms

- Reuse the **students** table from above.
- The **dorms** table lists all the on-campus dorm rooms occupied by students.

### a) List the names of students who live in the dorms and where they live.

Write the SQL query and execute the query to test it in DB Browser for SQLite.

```sql
SELECT students.first_name, students.last_name, dorms.building, dorms.room FROM students INNER JOIN dorms ON students.id=dorms.student_id;
```

You should get the following result:
| first_name | last_name | building | room |
| ---------- | --------- | -------- | ---- |
| John       | Piper     | Becker   | 213  |
| Kailey     | Madison   | Sheldon  | 101  |
| Krystal    | Chu       | Schuyler | 203  |
| Chloe      | Parker    | Risley   | 306  |
...
with 10 rows total.


### b) List the names of students who do not live on campus.

Write the SQL query and execute the query to test it in DB Browser for SQLite.

```sql
SELECT students.first_name, students.last_name FROM students LEFT OUTER JOIN dorms ON students.id=dorms.student_id WHERE dorms.building IS NULL;
```

You should get the following result:
|     | first_name | last_name |
| --- | ---------- | --------- |
| 1   | Savannah   | Kelly     |
| 2   | Hector     | Rivera    |
| 3   | Serena     | Pascal    |
...
with 6 rows total.


## Activity 3. Dogs and Owners

- The **dogs** table lists all the dogs who are patients for the 2300 Pet Clinic
- The **owners** table list the owners of the dogs as well as their contact information

### a) Find the owners who are current customers (their dogs are listed as patients).

Write the SQL query and execute the query to test it in DB Browser for SQLite.

```sql
SELECT DISTINCT owners.name FROM owners INNER JOIN dogs ON dogs.owner_id=owners.id;
```

You should get the following result:
|     | name   |
| --- | ------ |
| 1   | Jack   |
| 2   | Sally  |
| 3   | Jordan |
| 4   | Max    |
...
with 9 rows total.


### b) List all owners and their dogs.

Write the SQL query and execute the query to test it in DB Browser for SQLite.

```sql
SELECT owners.name, dogs.name FROM owners LEFT OUTER JOIN dogs ON dogs.owner_id=owners.id;
```

You should get the following result:
|     | name   | name  |
| --- | ------ | ----- |
| 1   | Jack   | Lucky |
| 2   | Jack   | Rover |
| 3   | Sally  | Cocoa |
| 4   | Jordan | Lucy  |
...
with 18 rows total.


### c) List the name and phone number of owners who own Retrievers.

Write the SQL query and execute the query to test it in DB Browser for SQLite.

```sql
SELECT DISTINCT owners.name, owners.phone FROM owners LEFT OUTER JOIN dogs ON dogs.owner_id=owners.id WHERE dogs.breed="Retriever";
```

You should get the following result:
|     | name | phone        |
| --- | ---- | ------------ |
| 1   | Jack | 123-456-7890 |
| 2   | Dan  | 123-121-9871 |


### d) List only owners who currently have dogs as patients to the Clinic.

Write the SQL query and execute the query to test it in DB Browser for SQLite.

```sql
SELECT owners.name, dogs.name FROM owners INNER JOIN dogs ON dogs.owner_id=owners.id;
```

You should get the following result:
|     | name   | name  |
| --- | ------ | ----- |
| 1   | Jack   | Lucky |
| 2   | Sally  | Cocoa |
| 3   | Jordan | Lucy  |
| 4   | Max    | Toast |
...
with 13 rows total.


## Activity 4. Positions and Uniforms

- The **positions** table lists all the positions at the 2300's Football Team.
- The **uniforms** table list all the shirts in inventory.

### a) Find the number of uniforms we have for players.

Write the SQL query and execute the query to test it in DB Browser for SQLite.

```sql
SELECT positions.title, uniforms.quantity FROM positions LEFT OUTER JOIN uniforms ON positions.uniform_id=uniforms.id WHERE positions.title = "Player";
```

You should get the following result:
|     | position | quantity |
| --- | -------- | -------- |
| 1   | Player   | 12       |


### b) Find all the uniforms we have and had in stock and their respective positions, if any.

Write the SQL query and execute the query to test it in DB Browser for SQLite.

```sql
SELECT uniforms.color, positions.title FROM uniforms LEFT OUTER JOIN positions ON positions.uniform_id=uniforms.id;
```

You should get the following result:
|     | color         | title   |
| --- | ------------- | ------- |
| 1   | Black         | Manager |
| 2   | Grey          | Trainer |
| 3   | Navy Blue     | Coach   |
| 4   | Navy Blue/Red | Player  |
...
with 10 rows total


### c) Find the uniforms we no longer have assigned to a position.

Write the SQL query and execute the query to test it in DB Browser for SQLite.

```sql
SELECT uniforms.color FROM uniforms LEFT OUTER JOIN positions ON positions.uniform_id=uniforms.id WHERE uniform_id IS NULL;
```

You should get the following result:
|     | color        |
| --- | ------------ |
| 1   | Red          |
| 2   | White        |
| 3   | White/Black  |
| 4   | Yellow/Black |


### d) Find which positions only have 5 or less uniforms left.

Write the SQL query and execute the query to test it in DB Browser for SQLite.

```sql
SELECT positions.title, uniforms.quantity FROM uniforms INNER JOIN positions ON positions.uniform_id=uniforms.id WHERE quantity<=5;
```

You should get the following result:
|     | position | quantity |
| --- | -------- | -------- |
| 1   | Manager  | 4        |
| 2   | Coach    | 3        |
| 3   | Medical  | 0        |


## Activity 5. Recipes and Ingredients

- The **ingredients** table lists all the individual ingredients.
- The **recipes** table list all the recipes.
- The **recipe_ingredients** connects an ingredients to a recipe.

### a) Find the ingredients to make a sandwich.

Write the SQL query and execute the query to test it in DB Browser for SQLite.

```sql
SELECT ingredients.item FROM ingredients LEFT OUTER JOIN recipe_ingredients ON recipe_ingredients.ingredient_id=ingredients.id WHERE (SELECT id FROM recipes WHERE dish="Sandwich")=recipe_ingredients.dish_id;
```

You should get the following result:
|     | item       |
| --- | ---------- |
| 1   | Tomato     |
| 2   | Ham        |
| 3   | Bread      |
| 4   | Lettuce    |
| 5   | Mayonnaise |


### b) Find the ingredients to make a pizza.

Write the SQL query and execute the query to test it in DB Browser for SQLite.

```sql
SELECT ingredients.item FROM ingredients LEFT OUTER JOIN recipe_ingredients ON recipe_ingredients.ingredient_id=ingredients.id LEFT OUTER JOIN recipes ON recipe_ingredients.dish_id=recipes.id WHERE recipes.dish = "Pizza";
```

You should get the following result:
|     | item              |
| --- | ----------------- |
| 1   | Basil             |
| 2   | Pizza Dough       |
| 3   | Mozzarella Cheese |
| 4   | Tomato Sauce      |


### c) Find which recipes include Basil.

Write the SQL query and execute the query to test it in DB Browser for SQLite.

```sql
SELECT recipes.dish FROM recipes LEFT OUTER JOIN recipe_ingredients ON recipe_ingredients.dish_id=recipes.id LEFT OUTER JOIN ingredients ON recipe_ingredients.ingredient_id=ingredients.id WHERE ingredients.item = "Basil";
```

You should get the following result:
|     | dish      |
| --- | --------- |
| 1   | Spaghetti |
| 2   | Pizza     |


## Activity 6: Multiple Join queries with Ingredients and Recipes (***Optional***)

### a) Find recipes with no ingredients listed.

Write the SQL query and execute the query to test it in DB Browser for SQLite.

```sql
SELECT recipes.dish FROM recipes LEFT OUTER JOIN recipe_ingredients ON recipe_ingredients.dish_id=recipes.id LEFT OUTER JOIN ingredients ON recipe_ingredients.ingredient_id=ingredients.id WHERE ingredients.item IS NULL;
```

You should get the following result:
|     | dish              |
| --- | ----------------- |
| 1   | Kimchi Fried Rice |
| 2   | Curry             |


### b) Find the ingredients that aren't used in any of the Recipes.

Write the SQL query and execute the query to test it in DB Browser for SQLite.

```sql
SELECT ingredients.item FROM ingredients LEFT OUTER JOIN recipe_ingredients ON recipe_ingredients.ingredient_id=ingredients.id LEFT OUTER JOIN recipes ON recipe_ingredients.dish_id=recipes.id WHERE recipes.id IS NULL;
```

You should get the following result:
|     | item      |
| --- | --------- |
| 1   | Pork Loin |
| 2   | Lentils   |
| 3   | Quinoa    |
| 4   | Soy Sauce |
| 5   | Milk      |
