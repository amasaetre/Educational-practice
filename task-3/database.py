import sqlite3

class Database:
    def __init__(self):

        self.__db_connection = sqlite3.connect('app.db', check_same_thread=False)

        cursor = self.__db_connection.cursor()

        cursor.execute('''
        CREATE TABLE IF NOT EXISTS Users (
        id INTEGER PRIMARY KEY,
        login TEXT NOT NULL,
        password TEXT NOT NULL
        )
        ''')

        cursor.execute('''
        CREATE TABLE IF NOT EXISTS Tasks (
        id INTEGER PRIMARY KEY,
        name TEXT NOT NULL,
        date TEXT NOT NULL,
        priority INTEGER NOT NULL,
        user_id INTEGER NOT NULL
        )
        ''')

        self.__db_connection.commit()

    def __del__(self):

        self.__db_connection.close()

    def add_user(self, login, password):
        cursor = self.__db_connection.cursor()
        cursor.execute('INSERT INTO Users (login, password) VALUES (?, ?)', (login, password))
        self.__db_connection.commit()

    def get_user(self, login):
        cursor = self.__db_connection.cursor()
        cursor.execute('SELECT * FROM Users WHERE login=?', (login,))
        return cursor.fetchall()


    def add_task(self, name, date, priority, user_id):
        cursor = self.__db_connection.cursor()
        cursor.execute('INSERT INTO Tasks (name, date, priority, user_id) VALUES (?, ?, ?, ?)', (name, date, priority, user_id))
        self.__db_connection.commit()


    def delete_task(self, id):
        cursor = self.__db_connection.cursor()
        cursor.execute('DELETE FROM Tasks WHERE id=?', (id,))
        self.__db_connection.commit()


    def get_task(self, id):
        cursor = self.__db_connection.cursor()
        cursor.execute('SELECT * FROM Tasks WHERE id=?', (id,))
        self.__db_connection.commit()
