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


#include "ModelUserUpdate.h"

#include "SWGHelpers.h"

#include <QJsonDocument>
#include <QJsonArray>
#include <QObject>
#include <QDebug>

namespace api {

ModelUserUpdate::ModelUserUpdate(QString* json) {
    init();
    this->fromJson(*json);
}

ModelUserUpdate::ModelUserUpdate() {
    init();
}

ModelUserUpdate::~ModelUserUpdate() {
    this->cleanup();
}

void
ModelUserUpdate::init() {
    id = 0L;
    role_id = 0L;
    company_id = 0L;
    rfid = new QString("");
    username = new QString("");
    email = new QString("");
    fullname = new QString("");
    birthday = NULL;
    address = new QString("");
    sidn = new QString("");
    gender = 0;
    phone = new QString("");
}

void
ModelUserUpdate::cleanup() {



    if(rfid != nullptr) {
        delete rfid;
    }
    if(username != nullptr) {
        delete username;
    }
    if(email != nullptr) {
        delete email;
    }
    if(fullname != nullptr) {
        delete fullname;
    }
    if(birthday != nullptr) {
        delete birthday;
    }
    if(address != nullptr) {
        delete address;
    }
    if(sidn != nullptr) {
        delete sidn;
    }

    if(phone != nullptr) {
        delete phone;
    }
}

ModelUserUpdate*
ModelUserUpdate::fromJson(QString &json) {
    QByteArray array (json.toStdString().c_str());
    QJsonDocument doc = QJsonDocument::fromJson(array);
    QJsonObject jsonObject = doc.object();
    this->fromJsonObject(jsonObject);
    return this;
}

void
ModelUserUpdate::fromJsonObject(QJsonObject &pJson) {
    ::api::setValue(&id, pJson["id"], "qint64", "");
    ::api::setValue(&role_id, pJson["role_id"], "qint64", "");
    ::api::setValue(&company_id, pJson["company_id"], "qint64", "");
    ::api::setValue(&rfid, pJson["rfid"], "QString", "QString");
    ::api::setValue(&username, pJson["username"], "QString", "QString");
    ::api::setValue(&email, pJson["email"], "QString", "QString");
    ::api::setValue(&fullname, pJson["fullname"], "QString", "QString");
    ::api::setValue(&birthday, pJson["birthday"], "QDateTime", "QDateTime");
    ::api::setValue(&address, pJson["address"], "QString", "QString");
    ::api::setValue(&sidn, pJson["sidn"], "QString", "QString");
    ::api::setValue(&gender, pJson["gender"], "qint32", "");
    ::api::setValue(&phone, pJson["phone"], "QString", "QString");
}

QString
ModelUserUpdate::asJson ()
{
    QJsonObject* obj = this->asJsonObject();
    
    QJsonDocument doc(*obj);
    QByteArray bytes = doc.toJson();
    return QString(bytes);
}

QJsonObject*
ModelUserUpdate::asJsonObject() {
    QJsonObject* obj = new QJsonObject();
    obj->insert("id", QJsonValue(id));
    obj->insert("role_id", QJsonValue(role_id));
    obj->insert("company_id", QJsonValue(company_id));
    toJsonValue(QString("rfid"), rfid, obj, QString("QString"));
    toJsonValue(QString("username"), username, obj, QString("QString"));
    toJsonValue(QString("email"), email, obj, QString("QString"));
    toJsonValue(QString("fullname"), fullname, obj, QString("QString"));
    toJsonValue(QString("birthday"), birthday, obj, QString("QDateTime"));
    toJsonValue(QString("address"), address, obj, QString("QString"));
    toJsonValue(QString("sidn"), sidn, obj, QString("QString"));
    obj->insert("gender", QJsonValue(gender));
    toJsonValue(QString("phone"), phone, obj, QString("QString"));

    return obj;
}

qint64
ModelUserUpdate::getId() {
    return id;
}
void
ModelUserUpdate::setId(qint64 id) {
    this->id = id;
}

qint64
ModelUserUpdate::getRoleId() {
    return role_id;
}
void
ModelUserUpdate::setRoleId(qint64 role_id) {
    this->role_id = role_id;
}

qint64
ModelUserUpdate::getCompanyId() {
    return company_id;
}
void
ModelUserUpdate::setCompanyId(qint64 company_id) {
    this->company_id = company_id;
}

QString*
ModelUserUpdate::getRfid() {
    return rfid;
}
void
ModelUserUpdate::setRfid(QString* rfid) {
    this->rfid = rfid;
}

QString*
ModelUserUpdate::getUsername() {
    return username;
}
void
ModelUserUpdate::setUsername(QString* username) {
    this->username = username;
}

QString*
ModelUserUpdate::getEmail() {
    return email;
}
void
ModelUserUpdate::setEmail(QString* email) {
    this->email = email;
}

QString*
ModelUserUpdate::getFullname() {
    return fullname;
}
void
ModelUserUpdate::setFullname(QString* fullname) {
    this->fullname = fullname;
}

QDateTime*
ModelUserUpdate::getBirthday() {
    return birthday;
}
void
ModelUserUpdate::setBirthday(QDateTime* birthday) {
    this->birthday = birthday;
}

QString*
ModelUserUpdate::getAddress() {
    return address;
}
void
ModelUserUpdate::setAddress(QString* address) {
    this->address = address;
}

QString*
ModelUserUpdate::getSidn() {
    return sidn;
}
void
ModelUserUpdate::setSidn(QString* sidn) {
    this->sidn = sidn;
}

qint32
ModelUserUpdate::getGender() {
    return gender;
}
void
ModelUserUpdate::setGender(qint32 gender) {
    this->gender = gender;
}

QString*
ModelUserUpdate::getPhone() {
    return phone;
}
void
ModelUserUpdate::setPhone(QString* phone) {
    this->phone = phone;
}


}

