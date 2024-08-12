from flask import Flask, request
from database import *
import json

app = Flask(__name__)

db = Database()

@app.route("/")
def hello_world():
    return "<p>Hello, World!</p>"

@app.route("/auth", methods=['POST'])
def auth():

    json_data = request.get_json()
    login = json_data['login']
    password = json_data['password']

    db_resp = db.get_user(login)
    db_password = db_resp[0][2]

    if db_password == password:
        return (json.dumps(ensure_ascii=False, obj={
            'success': True,
            'message': f'Успешная авторизация'
            }), 200, {'ContentType': 'application/json'}
        )

    return (json.dumps(ensure_ascii=False, obj={
        'success': False,
        'message': 'Введеные данных авторизации неверны'
        }), 400, {'ContentType': 'application/json'}
    )

@app.route("/register", methods=['POST'])
def register():

    json_data = request.get_json()
    login = json_data['login']
    password = json_data['password']


    db_resp = db.get_user(login)


    if not db_resp:

        db.add_user(login, password)

        return (json.dumps(ensure_ascii=False, obj={
            'success': True,
            'message': f'Пользователь {login} успешно зарегистрирован'
            }), 200, {'ContentType': 'application/json'}
        )

    return (json.dumps(ensure_ascii=False, obj={
        'success': False,
        'message': f'Пользователь {login} уже зарегистрирован'
         }), 400, {'ContentType': 'application/json'}
    )



if __name__ == "__main__":
    app.run(host='0.0.0.0', port=4567)