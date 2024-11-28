@app.route("/get_class_codes", methods=["GET"])
def get_class_codes():
    user = session.get("user")
    if not user or users[user]["role"] != "admin":
        return jsonify({"error": "管理者のみが閲覧可能です"}), 403

    return jsonify({"class_codes": class_codes}), 200
