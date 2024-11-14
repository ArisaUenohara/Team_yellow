from flask import Flask, jsonify, request, render_template

app = Flask(__name__)

# ユーザーデータ (例: ユーザー名、パスワード、役割、クラスID)
users = {
    "admin": {"password": "adminpass", "role": "admin", "classID": None},
    "user1": {"password": "user1pass", "role": "user", "classID": "class1"},
    "user2": {"password": "user2pass", "role": "user", "classID": "class2"},
}

# 回答データ
responses = [
    {"classID": "class1", "user": "user1", "answer": "回答1"},
    {"classID": "class2", "user": "user2", "answer": "回答2"},
    {"classID": "class1", "user": "user3", "answer": "回答3"},
]

@app.route('/')
def login_page():
    return render_template('index.html')

@app.route("/login", methods=["POST"])
def login():
    data = request.json
    username = data.get("username")
    password = data.get("password")

    user = users.get(username)
    if user and user["password"] == password:
        return jsonify({"role": user["role"], "classID": user["classID"]}), 200
    else:
        return jsonify({"error": "ログイン失敗"}), 401

@app.route("/responses", methods=["GET"])
def get_responses():
    class_id = request.args.get("classID")
    filtered_responses = [response for response in responses if response["classID"] == class_id]
    return jsonify(filtered_responses)

if __name__ == "__main__":
    app.run(debug=True)
