@app.route("/register", methods=["POST"])
def register():
    data = request.json
    username = data.get("username")
    password = data.get("password")
    class_code = data.get("class_code")

    # 必須チェック
    if not username or not password or not class_code:
        return jsonify({"error": "全ての項目を入力してください"}), 400

    # ユーザー名の重複チェック
    if username in users:
        return jsonify({"error": "このユーザーIDは既に使用されています"}), 400

    # ユーザー登録
    users[username] = {
        "password": password,
        "role": "user",  # 新規ユーザーは一般ユーザーとして登録
        "classID": class_code,
    }

    return jsonify({"message": "登録完了"}), 201
