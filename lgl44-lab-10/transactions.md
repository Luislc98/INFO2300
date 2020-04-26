# Transaction Practice

**Objective**: Read the scenario and the queries and determine whether it should be a transaction or not.

All answers should have an explanation or example to support your answer of "Yes" or "No".

Below we have provided a description of the scenario, some entries in your table, and SQL queries you used to execute the scenario. You should notice we don't provide all the code/information to execute scenarios. It is not sufficient to just look at the SQL queries as the steps you need to take. This is why we are providing you with scenarios, a lot of the query results would have to be stored and reused into the query. Treat each query individually as they can be in different parts of the PHP file. As long as your answers justify the assumptions you make (of how the code was implemented with the queries provided), you are doing it right!

**patrons**
| id  | first_name | last_name |
| --- | ---------- | --------- |
| 1   | John       | Piper     |
| 2   | Kailey     | Madison   |
| 3   | Savannah   | Kelly     |
| 4   | Krystal    | Chu       |
| 5   | Chloe      | Parker    |
| 6   | Ashley     | Dickerman |
| .   | ...        | ...       |

**books**
| id  | book_title               | author              | borrowed |
| --- | ------------------------ | ------------------- | -------- |
| 1   | Pride and Prejudice      | Jane Austen         | true     |
| 2   | Great Expectations       | Charles Dickens     | false    |
| 3   | The Great Gatsby         | F. Scott Fitzgerald | false    |
| 4   | Beloved                  | Toni Morrison       | false    |
| 5   | A Tree Grows in Brooklyn | Betty Smith         | true     |
| .   | ...                      | ...                 | ...      |

**borrowed_books**
| id  | book_id | patron_id |
| --- | ------- | --------- |
| 1   | 1       | 1         |
| 2   | 5       | 4         |
| .   | ...     | ...       |


1. A patron wants to know if "A Tree Grows in Brooklyn" is currently available.
    ```sql
    SELECT borrowed FROM books WHERE book_title="A Tree Grows in Brooklyn";
    ```

    **_This first question been filled out for your reference._**


    1. What are the steps to finish the scenario?

      > Search whether a book_title is in a borrowed table

    2. Does checking partway in the scenario cause incorrect information?

      > No, only one step so there is no partway point

    3. Will there be an issue if one of the steps fails?

      > No, only one step so either it all fails or all succeeds

    4. Does this require a transaction?

      > No

    5. If you answered yes to the above, what is a possible issue that could occur without a transaction?

      > N/A

2. Someone donated The Joy Luck Club to the library
    ```sql
    INSERT INTO books (book_title, author, borrowed) VALUES ("The Joy Luck Club", "Amy Tan", "false");
    ```

    1. What are the steps to finish the scenario?
    See if the donator is currently a patron and if not make him/her one


    2. Does checking partway in the scenario cause incorrect information?
    No there is only one step


    3. Will there be an issue if one of the steps fails?
    No one step so it fails or it succeeds


    4. Does this require a transaction?
    No

    5. If you answered yes to the above, what is a possible issue that could occur without a transaction?


3. A new patron wants to borrow "Beloved".
    ```sql
    INSERT INTO patrons (first_name, last_name) VALUES ("Peter","Parker");
    SELECT id, borrowed FROM books WHERE book_title="Beloved" AND author="Toni Morrison";
    SELECT id FROM patrons WHERE first_name="Peter" AND last_name="Parker";
    UPDATE books SET borrowed="true" WHERE book_title="Beloved" AND author="Toni Morrison";
    INSERT INTO borrowed_books (book_id, patron_id) VALUES (:book_id,:patron_id);
    ```

    1. What are the steps to finish the scenario?
    No further steps needed

    2. Does checking partway in the scenario cause incorrect information?
      yes checking partway can lead to incorrect insert statements not working properly

    3. Will there be an issue if one of the steps fails?
    YEs, there will be an issue in one of the insert statements if one of the select queries doesnt select anything


    4. Does this require a transaction?
    yes it will to avoid errors

    5. If you answered yes to the above, what is a possible issue that could occur without a transaction?


4. A patron wants to return "Pride and Prejudice"
    ```sql
    SELECT id FROM books WHERE book_title="Pride and Prejudice" AND author="Jane Austen";
    DELETE FROM borrowed_books WHERE book_id=:book_id;
    UPDATE books SET borrowed="false" WHERE book_title="Pride and Prejudice" AND author="Jane Austen";
    ```

    1. What are the steps to finish the scenario?
      No steps needed

    2. Does checking partway in the scenario cause incorrect information?
      yes  checking in delete will cause it to not delte correctly

    3. Will there be an issue if one of the steps fails?
      yes if there is no book with that infromation, the delete step will have an error

    4. Does this require a transaction?
      yes because there could be an issue at one of the steps

    5. If you answered yes to the above, what is a possible issue that could occur without a transaction?


5. A patron changed their surname and would like to update their account
    ```sql
    UPDATE patrons SET last_name="Goodman" WHERE first_name="Ashley" AND last_name="Dickerman";
    ```

    1. What are the steps to finish the scenario?
      No further steps needed

    2. Does checking partway in the scenario cause incorrect information?
      No there is no partway

    3. Will there be an issue if one of the steps fails?
       Only one step

    4. Does this require a transaction?
    No

    5. If you answered yes to the above, what is a possible issue that could occur without a transaction?
