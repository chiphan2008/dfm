/**
 * SMARTBUS API
 * No description provided (generated by Swagger Codegen https://github.com/swagger-api/swagger-codegen)
 *
 * OpenAPI spec version: 1.0.0
 * 
 *
 * NOTE: This class is auto generated by the swagger code generator program.
 * https://github.com/swagger-api/swagger-codegen.git
 * Do not edit the class manually.
 */


#include "ModelRoleForm.h"

#include "SWGHelpers.h"

#include <QJsonDocument>
#include <QJsonArray>
#include <QObject>
#include <QDebug>

namespace api {

ModelRoleForm::ModelRoleForm(QString* json) {
    init();
    this->fromJson(*json);
}

ModelRoleForm::ModelRoleForm() {
    init();
}

ModelRoleForm::~ModelRoleForm() {
    this->cleanup();
}

void
ModelRoleForm::init() {
    id = 0L;
    name = new QString("");
    display_name = new QString("");
}

void
ModelRoleForm::cleanup() {

    if(name != nullptr) {
        delete name;
    }
    if(display_name != nullptr) {
        delete display_name;
    }
}

ModelRoleForm*
ModelRoleForm::fromJson(QString &json) {
    QByteArray array (json.toStdString().c_str());
    QJsonDocument doc = QJsonDocument::fromJson(array);
    QJsonObject jsonObject = doc.object();
    this->fromJsonObject(jsonObject);
    return this;
}

void
ModelRoleForm::fromJsonObject(QJsonObject &pJson) {
    ::api::setValue(&id, pJson["id"], "qint64", "");
    ::api::setValue(&name, pJson["name"], "QString", "QString");
    ::api::setValue(&display_name, pJson["display_name"], "QString", "QString");
}

QString
ModelRoleForm::asJson ()
{
    QJsonObject* obj = this->asJsonObject();
    
    QJsonDocument doc(*obj);
    QByteArray bytes = doc.toJson();
    return QString(bytes);
}

QJsonObject*
ModelRoleForm::asJsonObject() {
    QJsonObject* obj = new QJsonObject();
    obj->insert("id", QJsonValue(id));
    toJsonValue(QString("name"), name, obj, QString("QString"));
    toJsonValue(QString("display_name"), display_name, obj, QString("QString"));

    return obj;
}

qint64
ModelRoleForm::getId() {
    return id;
}
void
ModelRoleForm::setId(qint64 id) {
    this->id = id;
}

QString*
ModelRoleForm::getName() {
    return name;
}
void
ModelRoleForm::setName(QString* name) {
    this->name = name;
}

QString*
ModelRoleForm::getDisplayName() {
    return display_name;
}
void
ModelRoleForm::setDisplayName(QString* display_name) {
    this->display_name = display_name;
}


}
